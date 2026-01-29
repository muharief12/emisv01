<?php

namespace App\Filament\Widgets;

use App\Models\Finance;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $incomes = Finance::whereHas('type', function ($q) {
            $q->where('type', 'income');
        })->sum('total');

        $expenses = Finance::whereHas('type', function ($q) {
            $q->where('type', 'expense');
        })->sum('total');
        $totalFin = $incomes - $expenses;
        $tabungan = Finance::whereHas('type', function ($q) {
            $q->where('name', 'Tabungan');
        })->sum('total');
        $infaq = Finance::whereHas('type', function ($q) {
            $q->where('name', 'Infaq');
        })->sum('total');
        $santriwati = User::count();

        return [
            Stat::make('Santri/wati', $santriwati . ' Orang'),
            Stat::make('Saldo', 'Rp ' . $totalFin),
            Stat::make('Total Tabungan', 'Rp ' . $tabungan),
            Stat::make('Total Infaq', 'Rp ' . $infaq),
        ];
    }
}
