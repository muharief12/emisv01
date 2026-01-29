<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\ChartWidget;

class StudentPieChart extends ChartWidget
{
    protected ?string $heading = 'Santri/wati berdasarkan Level';

    protected function getData(): array
    {
        $iqroStudent = User::where('role', 'student')->where('level', 'iqro')->count();
        $juzAmmaStudent = User::where('role', 'student')->where('level', 'juz_amma')->count();
        $quranStudent = User::where('role', 'student')->where('level', 'quran')->count();
        return [
            'labels' => [
                'Iqro',
                'Juz Amma',
                'Quran',
            ],
            'datasets' => [
                [
                    'label' => 'Total Santri/wati : ',
                    'data' => [
                        $iqroStudent,
                        $juzAmmaStudent,
                        $quranStudent,
                    ],
                    'backgroundColor' => [
                        '#3B82F6', // Blue - Iqro
                        '#10B981', // Green - Juz Amma
                        '#F59E0B', // Amber - Quran
                    ],
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
