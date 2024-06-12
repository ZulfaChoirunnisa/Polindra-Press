<?php

use Illuminate\Support\Facades\Route;
// use Illmuinate\Support\Facedes\Auth;
use App\Http\Controllers\Admin\BukuController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Pengaju\BukuController as PengajuBukuController;
use App\Http\Controllers\Pengaju\HasilReviewController;
use App\Http\Controllers\Pengaju\PengajuProfileController;
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

Route::middleware(['auth', 'user-access:admin'])->group(function () {
    Route::prefix('Admin')->group(function () {
        Route::get('buku/dashboard', [BukuController::class, 'dashboard'])->name('Admin.Buku.Dashboard');
        Route::get('buku', [BukuController::class, 'index'])->name('Admin.Buku.Index');
        Route::post('buku/review/{id}', [BukuController::class, 'postreview'])->name('Admin.Buku.postreview');
        Route::get('buku/download', [BukuController::class, 'download'])->name('Admin.Buku.Download');
        Route::get('buku/edit/{id}', [BukuController::class, 'edit'])->name('Admin.Buku.Edit');
        Route::put('buku/review/edit/{id}', [BukuController::class, 'storeedit'])->name('Admin.Buku.Storeedit');
        Route::get('export-users', [BukuController::class, 'exportBukuUsers'])->name('export.users');
        Route::get('Buku/Publish', [BukuController::class, 'Publish'])->name('Admin.Buku.Publish');
        Route::put('Buku/Publish/{id}', [BukuController::class, 'publishBuku'])->name('Admin.Buku.Publish.Post');
        Route::get('buku/profileadmin', [BukuController::class, 'profileadmin'])->name('Admin.Buku.Profileadmin');
        Route::put('buku/profileadmin/update', [BukuController::class, 'update'])->name('Admin.profileadmin.update');
        Route::put('buku/profileadmin/reset-password', [BukuController::class, 'reset'])->name('Admin.profileadmin.reset');
    });
});

Route::middleware(['auth', 'user-access:pengaju'])->group(function () {
    Route::prefix('Pengaju')->group(function () {
        Route::prefix('buku')->group(function () {
            Route::get('review', [HasilReviewController::class, 'index'])->name('Pengaju.Buku.hasilreview');
            Route::get('create', [PengajuBukuController::class, 'create'])->name('Pengaju.Buku.Create');
            Route::post('create', [PengajuBukuController::class, 'store'])->name('Pengaju.Buku.Store');

            Route::get('edithasilreview/{id}', [HasilReviewController::class, 'editReview'])->name('Pengaju.Buku.Editreview');
            Route::put('hasilreview/editreview/{id}', [HasilReviewController::class, 'updateReview'])->name('Pengaju.Buku.updatereview');

            Route::get('profile', [PengajuProfileController::class, 'profile'])->name('Pengaju.Buku.Profile');
            Route::put('profile/update', [PengajuProfileController::class, 'update'])->name('Pengaju.profile.update');
            Route::put('profile/reset', [PengajuProfileController::class, 'reset'])->name('Pengaju.profile.reset');
        });
    });
});
