<?php

use Inertia\Inertia;
use App\Models\Pinjaman;
use App\Models\Notifikasi;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LelangController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\NasabahController;
use App\Http\Controllers\AngsuranController;
use App\Http\Controllers\PinjamanController;
use App\Http\Controllers\DashboardController;

route::get('/', [AuthController::class, 'signin'])->name('login')->middleware('throttle:login');;
route::post('/auth', [AuthController::class, 'auth']);
route::delete('/logout', [AuthController::class, 'signout'])->middleware('auth');




route::middleware(['auth'])->group(function () {
    route::get('/dashboard', [DashboardController::class, 'index'])->middleware('Admin');
    route::get('/report', [ReportController::class, 'index']);
    route::get('/export', [ReportController::class, 'export']);
    route::post('/angsuran', [AngsuranController::class, 'store']);

    route::get('notification-success/{id}', function ($id) {
        Notifikasi::query()->where('id', $id)->update([
            'status' => 'complete'
        ]);
    });

    route::get('/file/{id}/draft', function ($id) {
        $data = Pinjaman::query()->with('nasabah')->where('code_pinjam', $id)->get();
        return Inertia::render('draftPerjanjian', [
            'data' => $data
        ]);
    });

    route::resource('nasabah', NasabahController::class);
    route::resource('pinjaman', PinjamanController::class);
    route::resource('lelang', LelangController::class)->middleware('Admin');
    route::resource('user', UserController::class)->middleware('Admin');
});
