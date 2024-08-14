<?php

use App\Http\Controllers\Admin\AdminProfileController;
use Illuminate\Support\Facades\Route;
// use Illmuinate\Support\Facedes\Auth;
use App\Http\Controllers\Admin\BukuController;
use App\Http\Controllers\AppController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Pengaju\BukuController as PengajuBukuController;
use App\Http\Controllers\Pengaju\HasilReviewController;
use App\Http\Controllers\Pengaju\PengajuProfileController;
use App\Http\Controllers\SuperAdmin\AdminController;
use App\Http\Controllers\SuperAdmin\PengajuController;
use App\Http\Controllers\SuperAdmin\ProfileController;
use App\Models\Buku;
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

Route::get('/', [AppController::class, 'home']);

Route::get('/detailBuku/{id}', [AppController::class, 'detailBuku']);

Route::get('/login', function () {
    return view('auth.login');
});

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);

Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register.index');
Route::post('register', [RegisterController::class, 'register'])->name('register');

Route::get('/about', function () {
    return view('about');
});

Route::get('/db', function () {
    $data['buku'] = Buku::where('publish', 'is_publish')->get();
    return view('DaftarBuku', $data);
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

        Route::get('buku/profileadmin', [AdminProfileController::class, 'profileadmin'])->name('Admin.Buku.Profileadmin');
        Route::put('buku/profileadmin/update', [AdminProfileController::class, 'update'])->name('Admin.profileadmin.update');
        Route::put('buku/profileadmin/reset-password', [AdminProfileController::class, 'reset'])->name('Admin.profileadmin.reset');
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

Route::middleware(['auth', 'user-access:superadmin'])->group(function () {
    Route::prefix('SuperAdmin')->group(function () {
        Route::prefix('account')->group(function () {
            Route::prefix('admin')->name('SuperAdmin.Account.Admin.')->group(function () {
                Route::get('/', [AdminController::class, 'index'])->name('Index');
                Route::post('/', [AdminController::class, 'store'])->name('Store');
                Route::put('/{id}', [AdminController::class, 'update'])->name('Update');
                Route::delete('/{id}', [AdminController::class, 'delete'])->name('Delete');
            });
            Route::prefix('pengaju')->name('SuperAdmin.Account.Pengaju.')->group(function () {
                Route::get('/', [PengajuController::class, 'index'])->name('Index');
                Route::post('/', [PengajuController::class, 'store'])->name('Store');
                Route::put('/{id}', [PengajuController::class, 'update'])->name('Update');
                Route::delete('/{id}', [PengajuController::class, 'delete'])->name('Delete');
            });
        });

        Route::prefix('buku')->name('SuperAdmin.Buku.')->group(function () {
            Route::get('/', [BukuController::class, 'index'])->name('Index');
            Route::get('download', [BukuController::class, 'download'])->name('Download');
            Route::get('profile', [ProfileController::class, 'profile'])->name('Profile');
            Route::put('profile/update', [ProfileController::class, 'update'])->name('profile.update');
            Route::put('profile/reset', [ProfileController::class, 'reset'])->name('profile.reset');
        });

        Route::get('export-users', [BukuController::class, 'exportBukuUsers'])->name('SuperAdmin.Export');
    });
});
