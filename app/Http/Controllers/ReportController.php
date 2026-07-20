<?php

namespace App\Http\Controllers;

use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function preview(Request $request, $bulan, $tahun)
    {
        $bulan = (int) $bulan;
        $tahun = (int) $tahun;

        $users = User::query()
            ->role('Santri/wati')
            ->select('users.*')
            ->withCount([
                'iqroLearnings as total_iqro' => function ($q) use ($bulan, $tahun) {
                    $q->whereHas('journal', function ($journal) use ($bulan, $tahun) {
                        $journal->whereMonth('time', $bulan)
                            ->whereYear('time', $tahun);
                    });
                },
                'iqroLearnings as lancar_iqro' => function ($q) use ($bulan, $tahun) {
                    $q->where('status', 'good')->whereHas('journal', function ($journal) use ($bulan, $tahun) {
                        $journal->whereMonth('time', $bulan)
                            ->whereYear('time', $tahun);
                    });
                },
                'quranLearnings as total_quran' => function ($q) use ($bulan, $tahun) {
                    $q->whereHas('journal', function ($journal) use ($bulan, $tahun) {
                        $journal->whereMonth('time', $bulan)
                            ->whereYear('time', $tahun);
                    });
                },
                'quranLearnings as lancar_quran' => function ($q) use ($bulan, $tahun) {
                    $q->where('status', 'good')->whereHas('journal', function ($journal) use ($bulan, $tahun) {
                        $journal->whereMonth('time', $bulan)
                            ->whereYear('time', $tahun);
                    });
                }
            ])
            ->get();

        $pdf = Pdf::loadView('pdf.laporan-pembelajaran', [
            'users' => $users,
            'bulan_nama' => Carbon::create(null, $bulan, 1)->translatedFormat('F'),
            'tahun' => $tahun,
            'now' => now()->translatedFormat('d F Y'),
        ]);

        return $pdf->stream("Laporan_Pembelajaran_{$bulan}_{$tahun}.pdf");
    }
}
