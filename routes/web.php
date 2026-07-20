<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::redirect('/', '/admin/login');


Route::get('/laporan-pembelajaran/{bulan}/{tahun}', [ReportController::class, 'preview'])
    ->name('laporan.pembelajaran');
