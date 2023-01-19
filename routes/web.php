<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\OutletController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\TransaksiController;

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

Route::get('/login', [LoginController::class, 'userLogin'])->name('login');
Route::get('/logout', [LoginController::class, 'userLogout']);
Route::post('/login', [LoginController::class, 'logProses']);

Route::get('/', fn() => view('welcome'));

Route::middleware('auth')->group(function() {

Route::get('/admin/dashboard', [DashboardController::class, 'index']);

Route::get('/admin/outlet/data-outlet', [OutletController::class, 'index']);
Route::post('/admin/outlet/tambah-outlet', [OutletController::class, 'createOutlet']);
Route::post('/admin/outlet/edit-outlet/{outlet}', [OutletController::class, 'editOutlet']);
Route::get('/admin/outlet/delete-outlet/{outlet}', [OutletController::class, 'deleteOutlet']);

Route::get('/admin/member/data-member', [MemberController::class, 'index']);
Route::post('/admin/member/tambah-member', [MemberController::class, 'createMember']);
Route::post('/admin/member/edit-member/{member}', [MemberController::class, 'editMember']);
Route::get('/admin/member/delete-member/{member}', [MemberController::class, 'deleteMember']);

Route::get('/admin/user/data-user', [UserController::class, 'index']);
Route::post('/admin/user/tambah-user', [UserController::class, 'createUser']);
Route::post('/admin/user/edit-user/{user}', [UserController::class, 'editUser']);
Route::get('/admin/user/delete-user/{user}', [UserController::class, 'deleteUser']);

Route::get('/admin/paket/data-paket', [PaketController::class, 'index']);
Route::post('/admin/paket/tambah-paket', [PaketController::class, 'createPaket']);
Route::post('/admin/paket/edit-paket/{paket}', [PaketController::class, 'editPaket']);
Route::get('/admin/paket/delete-paket/{paket}', [PaketController::class, 'deletePaket']);

Route::get('admin/transaksi/data-transaksi', [TransaksiController::class, 'index']);
Route::post('admin/transaksi/tambah-transaksi', [TransaksiController::class, 'createTransaksi']);
Route::post('admin/transaksi/edit-transaksi/{transaksi}', [TransaksiController::class, 'editTransaksi']);
Route::get('admin/transaksi/delete-transaksi/{transaksi}', [TransaksiController::class, 'deleteTransaksi']);
Route::get('admin/transaksi/detail-transaksi/{transaksi}', [TransaksiController::class, 'detailTransaksi']);

Route::get('kasir/dashboard', [DashboardController::class, 'indexKasir']);

Route::get('/kasir/member/data-member', [MemberController::class, 'index']);
Route::post('/kasir/member/tambah-member', [MemberController::class, 'createMember']);
Route::post('/kasir/member/edit-member/{member}', [MemberController::class, 'editMember']);
Route::get('/kasir/member/delete-member/{member}', [MemberController::class, 'deleteMember']);

Route::get('kasir/transaksi/data-transaksi', [TransaksiController::class, 'index']);
Route::post('kasir/transaksi/tambah-transaksi', [TransaksiController::class, 'createTransaksi']);
Route::post('kasir/transaksi/edit-transaksi/{transaksi}', [TransaksiController::class, 'editTransaksi']);
Route::get('kasir/transaksi/detail-transaksi/{transaksi}', [TransaksiController::class, 'detailTransaksi']);

Route::get('owner/dashboard', [DashboardController::class, 'indexOwner']);

Route::get('owner/transaksi/data-transaksi', [TransaksiController::class, 'index']);
Route::get('owner/transaksi/detail-transaksi/{transaksi}', [TransaksiController::class, 'detailTransaksi']);

// Route::get('admin/transaksi/detail-transaksi/{transaksi}', [DetailController::class, 'indexDetail']);
// Route::get('kasir/transaksi/detail-transaksi/{transaksi}', [DetailController::class, 'indexDetail']);
// Route::get('owner/transaksi/detail-transaksi/{transaksi}', [DetailController::class, 'indexDetail']);
});