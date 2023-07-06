<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

use App\Http\Controllers\POController;
use App\Http\Controllers\KlienController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\LokasiBarangController;
use App\Http\Controllers\KelompokBarangController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\LaporanStokBarangController;
use App\Http\Controllers\LaporanBarangMasukController;
use App\Http\Controllers\LaporanBarangKeluarController;


Route::get('/', function () {
	return redirect('sign-in');
})->middleware('guest');
Route::get('/cekData', [DashboardController::class, 'cekData'])->middleware('auth');
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');
Route::get('sign-up', [RegisterController::class, 'create'])->middleware('guest')->name('register');
Route::post('sign-up', [RegisterController::class, 'store'])->middleware('guest');
Route::get('sign-in', [SessionsController::class, 'create'])->middleware('guest')->name('login');
Route::post('sign-in', [SessionsController::class, 'store'])->middleware('guest');
Route::post('verify', [SessionsController::class, 'show'])->middleware('guest');
Route::post('reset-password', [SessionsController::class, 'update'])->middleware('guest')->name('password.update');
Route::get('verify', function () {
	return view('sessions.password.verify');
})->middleware('guest')->name('verify');
Route::get('/reset-password/{token}', function ($token) {
	return view('sessions.password.reset', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::post('sign-out', [SessionsController::class, 'destroy'])->middleware('auth')->name('logout');
Route::get('profile', [ProfileController::class, 'create'])->middleware('auth')->name('profile');
Route::post('user-profile', [ProfileController::class, 'update'])->middleware('auth');
Route::group(['middleware' => 'auth'], function () {
	
	Route::group(['middleware' => ['role:pemilik|manajer']], function () {
		// Dapat diakses oleh user dengan role pemilik atau manajer
		Route::resource('user-management', UserManagementController::class);
		Route::get('/laporan-barang-masuk', [LaporanBarangMasukController::class, 'index'])->name('laporan-barang-masuk.index');
		Route::get('/laporan-barang-masuk/export-pdf', [LaporanBarangMasukController::class, 'exportPDF'])->name('laporan-barang-masuk.export');
		Route::get('/laporan-barang-keluar', [LaporanBarangKeluarController::class, 'index'])->name('laporan-barang-keluar.index');
		Route::get('/laporan-barang-keluar/export-pdf', [LaporanBarangKeluarController::class, 'exportPDF'])->name('laporan-barang-keluar.export');
		Route::get('/laporan-stok-barang', [LaporanStokBarangController::class, 'index'])->name('laporan-stok-barang.index');
		Route::get('/laporan-stok-barang/export-pdf', [LaporanStokBarangController::class, 'exportPDF'])->name('laporan-stok-barang.export');
	});
	
	Route::group(['middleware' => ['role:manajer']], function () {
		// Dapat diakses oleh user dengan role manajer
		Route::get('/ambilDataPO/{kode_po}', [POController::class, 'ambilDataPO']);
		Route::get('tambah-po-barang', [POController::class, 'tambahPO'])->name('po.tambah');
		Route::post('proses-po', [POController::class, 'prosesPO'])->name('po.simpan');
		Route::get('po-barang', [POController::class, 'indexPO'])->name('po.index');
		Route::get('barang-masuk', [BarangMasukController::class, 'indexBarangMasuk'])->name('barang-masuk.index');
		Route::get('barang-masuk/tambah', [BarangMasukController::class, 'tambahBarangMasuk'])->name('barang-masuk.tambah');
		Route::post('barang-masuk/proses', [BarangMasukController::class, 'prosesBarangMasuk'])->name('barang-masuk.simpan');
		Route::resource('project', ProjectController::class);
		Route::get('barang-keluar', [BarangKeluarController::class, 'index'])->name('barang-keluar.index');
		Route::get('barang-keluar/tambah', [BarangKeluarController::class, 'create'])->name('barang-keluar.tambah');
		Route::post('barang-keluar/proses', [BarangKeluarController::class, 'store'])->name('barang-keluar.simpan');
		Route::get('/ambilDataProject/{project_id}', [ProjectController::class, 'ambilDataProject']);
	
	});
	
	Route::group(['middleware' => ['role:staff|manajer']], function () {
		// Dapat diakses oleh user dengan role staff atau manajer
		Route::resource('kelompok-barang', KelompokBarangController::class);
		Route::resource('lokasi-barang', LokasiBarangController::class);
		Route::resource('barang', BarangController::class);
		Route::resource('supplier', SupplierController::class);
		Route::resource('klien', KlienController::class);
	});
});
