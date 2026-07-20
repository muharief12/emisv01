<?php

namespace App\Filament\Resources\Journals\Pages;

use App\Filament\Resources\Journals\JournalResource;
use Carbon\Carbon;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Actions\Action;
use Filament\Forms\Components\Select;

use function Symfony\Component\Clock\now;

class ListJournals extends ListRecords
{
    protected static string $resource = JournalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
            Action::make('cetak_laporan_bulanan')
                ->label('Cetak Laporan Pembelajaran')
                ->icon('heroicon-o-printer')
                ->form([
                    Select::make('bulan')
                        ->label('Pilih Bulan')
                        ->options([
                            '01' => 'Januari',
                            '02' => 'Februari',
                            '03' => 'Maret',
                            '04' => 'April',
                            '05' => 'Mei',
                            '06' => 'Juni',
                            '07' => 'Juli',
                            '08' => 'Agustus',
                            '09' => 'September',
                            '10' => 'Oktober',
                            '11' => 'November',
                            '12' => 'Desember',
                        ])
                        ->default(now()->format('m'))
                        ->required(),
                    Select::make('tahun')
                        ->label('Pilih Tahun')
                        ->options(array_combine(range(2025, 2030), range(2025, 2030)))
                        ->default(2026)
                        ->required(),
                ])
                ->action(function (array $data) {
                    $bulan = (int) $data['bulan'];
                    $tahun = (int) $data['tahun'];

                    // return route('laporan.pembelajaran', [
                    //     'bulan' => $bulan,
                    //     'tahun' => $tahun,
                    // ]);

                    $url = route('laporan.pembelajaran', [
                        'bulan' => $bulan,
                        'tahun' => $tahun,
                    ]);

                    return redirect()->away($url);
                })
                ->openUrlInNewTab()
        ];
    }
}
