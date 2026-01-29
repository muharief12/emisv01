<?php

namespace App\Filament\Widgets;

use App\Models\Journal;
use Filament\Widgets\ChartWidget;

class EducationActivityChart extends ChartWidget
{
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
                    'label' => 'Santri/wati',
                    'data' => $journals->map(fn($journal) => $journal->iqros->count())->values()->toArray(),
                    'backgroundColor' => [
                        '#3B82F6', // Blue - Iqro
                    ],
                ],
                [
                    'label' => 'Santri/wati',
                    'data' => $journals->map(fn($journal) => $journal->qurans->count())->values()->toArray(),
                    'backgroundColor' => [
                        '#F59E0B', // Amber - Quran
                    ],
                ],
            ],
            'labels' => $journals->map(
                fn($journal) =>
                'Pertemuan ' . $journal->id
            )->values()->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
