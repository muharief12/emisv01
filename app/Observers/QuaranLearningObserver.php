<?php

namespace App\Observers;

use App\Models\Journal;
use App\Models\Quran;
use App\Models\QuranLearning;
use App\Service\WahaService;

class QuaranLearningObserver
{
    protected WahaService $waha;

    public function __construct(WahaService $waha)
    {
        $this->waha = $waha;
    }

    /**
     * Handle the QuranLearning "created" event.
     */
    public function created(QuranLearning $quranLearning): void
    {
        $this->sendWhatsappNotification($quranLearning, 'created');
    }

    /**
     * Handle the QuranLearning "updated" event.
     */
    public function updated(QuranLearning $quranLearning): void
    {
        $this->sendWhatsappNotification($quranLearning, 'updated');
    }

    /**
     * Handle the QuranLearning "deleted" event.
     */
    public function deleted(QuranLearning $quranLearning): void
    {
        $this->sendWhatsappNotification($quranLearning, 'deleted');
    }

    /**
     * Handle the QuranLearning "restored" event.
     */
    public function restored(QuranLearning $quranLearning): void
    {
        //
    }

    /**
     * Handle the QuranLearning "force deleted" event.
     */
    public function forceDeleted(QuranLearning $quranLearning): void
    {
        //
    }

    protected function sendWhatsappNotification(QuranLearning $ql, string $action): void
    {
        if (! $ql->student || ! $ql->student->phone_number) {
            return;
        }

        $message = $this->buildMessage($ql, $action);

        $this->waha->sendMessage(
            $ql->student->phone_number . '@c.us',
            $message
        );
    }

    protected function buildMessage(QuranLearning $ql, string $action): string
    {
        $now = now()->toDateTimeString();
        $journalTime = Journal::where('id', $ql->journals_id)
            ->value('time') ?? '-';
        return match ($action) {
            'created' => "Assalamu’alaikum Bp/Ibu {$ql->student->parent_name}, Orang Tua dari {$ql->student->name} \n\n"
                . "- Evaluasi Pembelajaran Baca Al Qur'an telah terlaksana pada {$journalTime}.\n"
                . "- Mulai dari: QS. {$ql->quranStart->transliteration} Ayat {$ql->start_ayah}\n"
                . "- Sampai dengan: QS. {$ql->quranEnd->transliteration} Ayat {$ql->end_ayah}\n"
                . "- Catatan Pembelajaran: {$ql->note}\n"
                . "- Diperiksa Oleh: {$ql->teacher->name}" . "\n\n"
                . "- Terima kasih.\n#Pesan otomatis dari Sistem EMIS TPQ Al Jannah",

            'updated' => "Assalamu’alaikum Bp/Ibu {$ql->student->parent_name}, Orang Tua dari {$ql->student->name} \n\n"
                . "- Evaluasi Pembelajaran Baca Al Qur'an telah diperbarui pada {$journalTime}.\n"
                . "- Mulai dari: QS. {$ql->quranStart->transliteration} Ayat {$ql->start_ayah}\n"
                . "- Sampai dengan: QS. {$ql->quranEnd->transliteration} Ayat {$ql->end_ayah}\n"
                . "- Catatan Pembelajaran: {$ql->note}\n"
                . "- Diperiksa Oleh: {$ql->teacher->name}" . "\n\n"
                . "- Terima kasih.\n#Pesan otomatis dari Sistem EMIS TPQ Al Jannah",

            'deleted' => "Assalamu’alaikum Bp/Ibu {$ql->student->parent_name}, Orang Tua dari {$ql->student->name} \n\n"
                . "- Data Evaluasi Pembelajaran Baca Al Qur'an telah dihapus pada {$now}.\n"
                . "- Mulai dari: QS. {$ql->quranStart->name} Ayat {$ql->start_ayah}\n"
                . "- Sampai dengan: QS. {$ql->quranEnd->name} Ayat {$ql->end_ayah}\n"
                . "- Catatan Pembelajaran: {$ql->note}\n"
                . "- Diperiksa Oleh: {$ql->teacher->name}" . "\n\n"
                . "- Terima kasih.\n#Pesan otomatis dari Sistem EMIS TPQ Al Jannah",
        };
    }
}
