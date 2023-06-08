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

// Route::get('/', function () {
//     return view('welcome');
// });

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
// use App\Http\Controllers\TransaksiMasukController;
use App\Http\Controllers\KelompokBarangController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\LaporanBarangMasukController;


Route::get('/', function () {
	return redirect('sign-in');
})->middleware('guest');
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
	Route::get('billing', function () {
		return view('pages.billing');
	})->name('billing');
	Route::get('tables', function () {
		return view('pages.tables');
	})->name('tables');
	Route::get('rtl', function () {
		return view('pages.rtl');
	})->name('rtl');
	Route::get('virtual-reality', function () {
		return view('pages.virtual-reality');
	})->name('virtual-reality');
	Route::get('notifications', function () {
		return view('pages.notifications');
	})->name('notifications');
	Route::get('static-sign-in', function () {
		return view('pages.static-sign-in');
	})->name('static-sign-in');
	Route::get('static-sign-up', function () {
		return view('pages.static-sign-up');
	})->name('static-sign-up');
	// Route::get('user-management', function () {
	// 	return view('pages.laravel-examples.user-management');
	// })->name('user-management');
	Route::resource('user-management', UserManagementController::class);
	Route::resource('kelompok-barang', KelompokBarangController::class);
	Route::resource('lokasi-barang', LokasiBarangController::class);
	Route::resource('barang', BarangController::class);
	Route::resource('supplier', SupplierController::class);
	Route::resource('klien', KlienController::class);
	Route::get('/ambilDataPO/{kode_po}', [POController::class, 'ambilDataPO']);
	Route::get('tambah-po-barang', [POController::class, 'tambahPO'])->name('po.tambah');
	Route::post('proses-po', [POController::class, 'prosesPO'])->name('po.simpan');
	Route::get('po-barang', [POController::class, 'indexPO'])->name('po.index');
	Route::get('barang-masuk', [BarangMasukController::class, 'indexBarangMasuk'])->name('barang-masuk.index');
	Route::get('barang-masuk/tambah', [BarangMasukController::class, 'tambahBarangMasuk'])->name('barang-masuk.tambah');
	Route::post('barang-masuk/proses', [BarangMasukController::class, 'prosesBarangMasuk'])->name('barang-masuk.simpan');
	Route::resource('project', ProjectController::class);
	Route::get('/laporan-barang-masuk', [LaporanBarangMasukController::class, 'index'])->name('laporan-barang-masuk.index');
	Route::get('/laporan-barang-masuk/export-pdf', [LaporanBarangMasukController::class, 'exportPDF'])->name('laporan-barang-masuk.export');
	Route::get('barang-keluar', [BarangKeluarController::class, 'index'])->name('barang-keluar.index');
	Route::get('barang-keluar/tambah', [BarangKeluarController::class, 'create'])->name('barang-keluar.tambah');
	Route::post('barang-keluar/proses', [BarangKeluarController::class, 'store'])->name('barang-keluar.simpan');
	Route::get('/ambilDataProject/{project_id}', [ProjectController::class, 'ambilDataProject']);

	Route::get('user-profile', function () {
		return view('pages.laravel-examples.user-profile');
	})->name('user-profile');
});
