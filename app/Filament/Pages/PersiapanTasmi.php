<?php

namespace App\Filament\Pages;

use App\Models\QuranVerse;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Pages\Page;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class PersiapanTasmi extends Page implements HasForms
{
    use InteractsWithForms;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBookOpen;
    protected static ?string $navigationLabel = 'Persiapan Tasmi';
    protected string $view = 'filament.pages.latihan-tasmi';

    public ?array $data = [];
    public array $soalTasmi = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Schema $form): Schema
    {
        return $form
            ->schema([
                Section::make('Filter Soal Tasmi')
                    ->description('Pilih Juz untuk menghasilkan 5 potongan ayat acak (diurutkan berdasarkan halaman/posisi).')
                    ->schema([
                        Select::make('juz')
                            ->label('Pilih Juz')
                            ->options(array_combine(range(1, 30), array_map(fn($n) => "Juz {$n}", range(1, 30))))
                            ->required()
                            ->preload()
                            ->searchable()
                            ->native(false),
                        Actions::make([
                            Action::make('generate')
                                ->label('Acak Ayat')
                                ->icon('heroicon-m-sparkles')
                                ->action(fn() => $this->generateSoal()),
                        ])
                            ->columnSpan(['md' => 1]) // Button mengambil 1 kolom di paling kanan
                            ->alignEnd(), // Menyelaraskan posisi tombol agar rata bawah sejajar dengan Select
                    ])
                // ->action(
                //     Action::make('generate')
                //         ->label('Acak Ayat')
                //         ->icon('heroicon-m-sparkles')
                //         ->action(fn() => $this->generateSoal())
                // ),
            ])
            ->statePath('data');
    }

    public function generateSoal(): void
    {
        // Ambil data form yang sudah divalidasi
        $formData = $this->form->getState();
        $selectedJuz = $formData['juz'] ?? null;

        if (! $selectedJuz) {
            return;
        }

        // 1. Ambil 5 ayat acak berdasarkan Juz, lalu urutkan berdasarkan quran_id terkecil
        $randomVerses = QuranVerse::where('juz', $selectedJuz)
            ->inRandomOrder()
            ->limit(5)
            ->get()
            ->sortBy('quran_id');

        $result = [];
        $index = 1;

        foreach ($randomVerses as $verse) {
            // 2. Ambil 5 ayat berikutnya untuk kunci jawaban
            $nextVerses = QuranVerse::where('id', '>', $verse->id)
                ->orderBy('id', 'asc')
                ->limit(5)
                ->get();

            $result[] = [
                'nomor_soal' => $index++,
                'soal' => $verse,
                'kunci_jawaban' => $nextVerses,
            ];
        }

        $this->soalTasmi = $result;
    }
}
