<?php

namespace App\Observers;

use App\Models\EventPayment;
use App\Service\WahaService;

class EventPaymentObserver
{
    protected WahaService $waha;

    public function __construct(WahaService $waha)
    {
        $this->waha = $waha;
    }

    protected function updateEventTotal(EventPayment $payment): void
    {
        if (! $payment->event) {
            return;
        }

        $total = $payment->event
            ->payments()
            ->sum('cost');

        $payment->event->update([
            'total_payment' => $total,
        ]);
    }

    /**
     * Handle the Payment "created" event.
     */
    public function created(EventPayment $payment): void
    {
        $this->updateEventTotal($payment);
        $this->sendWhatsappNotification($payment, 'created');
    }

    /**
     * Handle the Payment "updated" event.
     */
    public function updated(EventPayment $payment): void
    {
        $this->updateEventTotal($payment);
        $this->sendWhatsappNotification($payment, 'updated');
    }

    /**
     * Handle the Payment "deleted" event.
     */
    public function deleted(EventPayment $payment): void
    {
        $this->updateEventTotal($payment);
        $this->sendWhatsappNotification($payment, 'deleted');
    }

    /**
     * Handle the Payment "restored" event.
     */
    public function restored(EventPayment $payment): void
    {
        //
    }

    /**
     * Handle the Payment "force deleted" event.
     */
    public function forceDeleted(EventPayment $payment): void
    {
        //
    }

    protected function sendWhatsappNotification(EventPayment $payment, string $action): void
    {
        if (! $payment->student || ! $payment->student->phone_number) {
            return;
        }

        $message = $this->buildMessage($payment, $action);

        $this->waha->sendMessage(
            $payment->student->phone_number . '@c.us',
            $message
        );
    }

    protected function buildMessage(EventPayment $payment, string $action): string
    {
        $now = now()->toDateTimeString();
        return match ($action) {
            'created' => "Assalamu’alaikum Bp/Ibu {$payment->student->parent_name}, Orang Tua dari {$payment->student->name} \n\n"
                . "Pembayaran Anda berhasil dicatat pada {$payment->updated_at}.\n"
                . "Event: {$payment->event->name}\n"
                . "Nominal: Rp " . number_format($payment->cost, 0, ',', '.') . "\n\n"
                . "Terima kasih.\n— Pesan otomatis dari Sistem EMIS TPQ Al Jannah",

            'updated' => "Assalamu’alaikum {$payment->student->name},\n\n"
                . "Data pembayaran Anda telah diperbarui pada {$payment->updated_at}.\n"
                . "Event: {$payment->event->name}\n"
                . "Nominal: Rp " . number_format($payment->cost, 0, ',', '.') . "\n\n"
                . "— Pesan otomatis dari Sistem EMIS TPQ Al Jannah",

            'deleted' => "Assalamu’alaikum {$payment->student->name} pada {$now},\n\n"
                . "Data pembayaran Anda telah dihapus dari sistem.\n"
                . "Event: {$payment->event->name}\n\n"
                . "— Pesan otomatis dari Sistem EMIS TPQ Al Jannah",
        };
    }
}
