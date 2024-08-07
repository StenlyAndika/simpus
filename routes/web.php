<?php

use Illuminate\Support\Facades\Route;
use Symfony\Component\Process\Process;
use App\Http\Controllers\DashboardObat;
use App\Http\Controllers\DashboardPoli;
use App\Http\Controllers\DashboardUser;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardEvent;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardApotek;
use App\Http\Controllers\DashboardDokter;
use App\Http\Controllers\DashboardLaporan;
use App\Http\Controllers\DashboardDiagnosa;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardPendaftaran;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [AuthController::class, 'index'])->name('welcome')->middleware('guest');

Route::post('/login', [AuthController::class, 'authenticate'])->name('auth')->middleware('guest');
Route::post('/generateSU', [DashboardUser::class, 'generateSU'])->name('superuser')->middleware(['guest', 'checksuper']);

Route::middleware(['admin'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/dashboard/create', [DashboardController::class, 'create'])->name('admin.dashboard.create');

    Route::get('/dashboard/pendaftaran', [DashboardPendaftaran::class, 'index'])->name('admin.pendaftaran.index');
    Route::get('/dashboard/pendaftaran/create', [DashboardPendaftaran::class, 'create'])->name('admin.pendaftaran.create');
    Route::post('/dashboard/pendaftaran', [DashboardPendaftaran::class, 'store'])->name('admin.pendaftaran.store');
    Route::put('/dashboard/pendaftaran/{idp}', [DashboardPendaftaran::class, 'update'])->name('admin.pendaftaran.update');
    Route::get('/dashboard/cetakkartu/{idpas}', [DashboardPendaftaran::class, 'cetakKartu'])->name('admin.dashboard.printkartu');
    
    Route::get('/dashboard/cekantri', [DashboardDiagnosa::class, 'cekAntri'])->name('admin.poli.cekantrian');
    Route::get('/dashboard/diagnosa/{idp}', [DashboardDiagnosa::class, 'index'])->name('admin.poli.diagnosa');
    Route::post('/dashboard/soap', [DashboardDiagnosa::class, 'savetempSOAP'])->name('admin.poli.storesoap');
    Route::post('/dashboard/ambilobat', [DashboardDiagnosa::class, 'savetempObat'])->name('admin.poli.storeobat');
    Route::post('/dashboard/diagnosa', [DashboardDiagnosa::class, 'store'])->name('admin.poli.diagnosa.store');
    Route::get('/dashboard/cekriwayat/{nik}', [DashboardDiagnosa::class, 'cekRiwayat'])->name('admin.poli.cekriwayat');
    Route::get('/dashboard/getriwayat/{idp}', [DashboardDiagnosa::class, 'getRiwayat'])->name('admin.poli.getriwayat');

    Route::get('/dashboard/apotek/{idp}', [DashboardApotek::class, 'index'])->name('admin.apotek.index');
    Route::post('/dashboard/apotek', [DashboardApotek::class, 'store'])->name('admin.apotek.store');
    Route::get('/dashboard/cetakresep/{idp}', [DashboardApotek::class, 'cetakResep'])->name('admin.apotek.printresep');

    Route::get('/dashboard/laporan/berobat', [DashboardLaporan::class, 'berobat'])->name('admin.laporan.berobat');
    Route::get('/dashboard/laporan/berobat/print/{tgl_awal}/{tgl_akhir}', [DashboardLaporan::class, 'printberobat'])->name('admin.laporan.printberobat');

    Route::get('/admin/user/{user}/show', [DashboardUser::class, 'show'])->name('admin.user.show');
    Route::put('/admin/user/{user}', [DashboardUser::class, 'update'])->name('admin.user.update');

    Route::get('/caripasien', [DashboardPendaftaran::class, 'caripasien'])->name('caripasien');
    Route::get('/getpasien/{idpas}', [DashboardPendaftaran::class, 'getpasien'])->name('getpasien');
    Route::get('/noantri/{poli}', [DashboardPendaftaran::class, 'noantri'])->name('noantri');
    Route::get('/getnomr', [DashboardPendaftaran::class, 'getnomr'])->name('getnorm');

    Route::get('/cariobat', [DashboardDiagnosa::class, 'cariobat'])->name('cariobat');
    Route::get('/get-temp-obat', [DashboardDiagnosa::class, 'gettempObat'])->name('gettempObat');
    Route::delete('/delete-obat/{id}', [DashboardDiagnosa::class, 'deleteObat']);

    Route::get('/debug-temp-soap', function () {
        return session('temp_soap_data', []);
    });

    Route::get('/debug-temp-obat', function () {
        return session('temp_obat_data', []);
    });

    Route::middleware(['root'])->group(function () {

        Route::get('/admin/master/dokter', [DashboardDokter::class, 'index'])->name('admin.dokter.index');
        Route::get('/admin/master/dokter/create', [DashboardDokter::class, 'create'])->name('admin.dokter.create');
        Route::post('/admin/master/dokter', [DashboardDokter::class, 'store'])->name('admin.dokter.store');
        Route::get('/admin/master/dokter/{dokter}', [DashboardDokter::class, 'show'])->name('admin.dokter.show');
        Route::get('/admin/master/dokter/{dokter}/edit', [DashboardDokter::class, 'edit'])->name('admin.dokter.edit');
        Route::put('/admin/master/dokter/{dokter}', [DashboardDokter::class, 'update'])->name('admin.dokter.update');
        Route::delete('/admin/master/dokter/{dokter}', [DashboardDokter::class, 'destroy'])->name('admin.dokter.destroy');

        Route::get('/admin/master/obat', [DashboardObat::class, 'index'])->name('admin.obat.index');
        Route::get('/admin/master/obat/create', [DashboardObat::class, 'create'])->name('admin.obat.create');
        Route::post('/admin/master/obat', [DashboardObat::class, 'store'])->name('admin.obat.store');
        Route::get('/admin/master/obat/{obat}', [DashboardObat::class, 'show'])->name('admin.obat.show');
        Route::get('/admin/master/obat/{obat}/edit', [DashboardObat::class, 'edit'])->name('admin.obat.edit');
        Route::put('/admin/master/obat/{obat}', [DashboardObat::class, 'update'])->name('admin.obat.update');
        Route::delete('/admin/master/obat/{obat}', [DashboardObat::class, 'destroy'])->name('admin.obat.destroy');

        Route::get('/admin/master/user', [DashboardUser::class, 'index'])->name('admin.user.index');
        Route::get('/admin/master/user/create', [DashboardUser::class, 'create'])->name('admin.user.create');
        Route::post('/admin/master/user', [DashboardUser::class, 'store'])->name('admin.user.store');
        Route::get('/admin/master/user/{user}/edit', [DashboardUser::class, 'edit'])->name('admin.user.edit');
    
        Route::put('/admin/master/user/{user}/updateroot', [DashboardUser::class, 'updateroot'])->name('admin.user.updateroot');
        Route::patch('/admin/master/user/{user}/set-admin', [DashboardUser::class, 'set_admin'])->name('admin.user.set_admin');
        Route::patch('/admin/master/user/{user}/set-root', [DashboardUser::class, 'set_root'])->name('admin.user.set_root');
    });
    Route::delete('/admin/user/{user}', [DashboardUser::class, 'destroy'])->name('admin.user.destroy');
});