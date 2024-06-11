<?php

use Illuminate\Support\Facades\Route;
// use Illmuinate\Support\Facedes\Auth;
use App\Http\Controllers\Admin\BukuController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Pengaju\BukuController as PengajuBukuController;
use Illuminate\Support\Facades\Auth;

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
Route::get('/', function () {
    return view('layouts.landingpage.index');
});

Route::get('/login', function () {
    return view('auth.login');
});

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);

Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register.index');
Route::post('register', [RegisterController::class, 'register'])->name('register');

Route::get('/about', function () {
    return view('About');
});

Route::get('/db', function () {
    return view('DaftarBuku');
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth','user-access:admin'])->group(function ()  {
    Route::get('Admin/buku/dashboard', [BukuController::class, 'dashboard'])->name('Admin.Buku.Dashboard');
    Route::get('Admin/buku',[BukuController::class, 'index'])->name('Admin.Buku.Index');
    Route::get('Admin/buku/review/{id}',[BukuController::class, 'review'])->name('Admin.Buku.Review');
    Route::post('Admin/buku/review/{id}',[BukuController::class, 'postreview'])->name('Admin.Buku.postreview');
    Route::get('Admin/buku/download',[BukuController::class, 'download'])->name('Admin.Buku.Download');
    Route::get('Admin/buku/edit/{id}',[BukuController::class, 'edit'])->name('Admin.Buku.Edit');
    Route::put('Admin/buku/review/edit/{id}',[BukuController::class, 'storeedit'])->name('Admin.Buku.Storeedit');
    Route::get('export-users', [BukuController::class, 'exportBukuUsers'])->name('export.users');
    Route::get('Admin/Buku/Publish', [BukuController::class, 'Publish'])->name('Admin.Buku.Publish');
    Route::post('Admin/Buku/Publish/{id}', [BukuController::class, 'publishBuku'])->name('Admin.Buku.Publish.Post');
    Route::get('Admin/buku/profileadmin',[BukuController::class, 'profileadmin'])->name('Admin.Buku.Profileadmin');
    Route::put('Admin/buku/profileadmin/update', [BukuController::class, 'update'])->name('Admin.profileadmin.update');
    Route::put('Admin/buku/profileadmin/reset-password', [BukuController::class, 'reset'])->name('Admin.profileadmin.reset');
}); 

Route::middleware(['auth','user-access:pengaju'])->group(function ()  {
    Route::get('Pengaju/buku/create',[PengajuBukuController::class, 'create'])->name('Pengaju.Buku.Create');
    Route::post('Pengaju/buku/create',[PengajuBukuController::class, 'store'])->name('Pengaju.Buku.Store');
    Route::get('Pengaju/buku/hasilreview',[PengajuBukuController::class, 'hasilreview'])->name('Pengaju.Buku.hasilreview');
    Route::get('Pengaju/buku/edithasilreview/{id}',[PengajuBukuController::class, 'editreview'])->name('Pengaju.Buku.Editreview');
    Route::put('Pengaju/buku/hasilreview/editreview/{id}',[PengajuBukuController::class, 'updatereview'])->name('Pengaju.Buku.updatereview');
    Route::get('Pengaju/buku/profile',[PengajuBukuController::class, 'profile'])->name('Pengaju.Buku.Profile');
    Route::put('Pengaju/buku/profile/update', [PengajuBukuController::class, 'update'])->name('Pengaju.profile.update');
    Route::put('Pengaju/buku/profile/reset', [PengajuBukuController::class, 'reset'])->name('Pengaju.profile.reset');
});
