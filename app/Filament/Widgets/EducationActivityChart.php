<?php

namespace App\Filament\Widgets;

use App\Models\Journal;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;

class EducationActivityChart extends ChartWidget
{
    use HasWidgetShield;

    protected ?string $heading = 'Sebaran Pembelajaran';
    protected static ?int $sort = 3;

    protected function getData(): array
    {
        $journals = Journal::withCount([
            'iqros',
            'qurans',
        ])
            ->latest()
            ->take(3)
            ->get()
            ->reverse(); // biar urut lama → baru di chart

        return [
            'datasets' => [
                [
                    'label' => "Iqro'",
                    'data' => $journals->map(fn($journal) => $journal->iqros->count())->values()->toArray(),
                    'backgroundColor' => [
                        '#3B82F6', // Blue - Iqro
                    ],
                ],
                [
                    'label' => "Qur'an",
                    'data' => $journals->map(fn($journal) => $journal->qurans->count())->values()->toArray(),
                    'backgroundColor' => [
                        '#F59E0B', // Amber - Quran
                    ],
                ],
            ],
            'labels' => $journals->map(
                fn($journal) =>
                Carbon::parse($journal->time)->translatedFormat('l, d F Y')

            )->values()->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
