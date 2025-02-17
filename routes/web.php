<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PortalController;

use App\Http\Controllers\Bed\BedController;
use App\Http\Controllers\Antrian\RadiologyController;
use App\Http\Controllers\Antrian\Table\DokterController;
use App\Http\Controllers\Antrian\Table\PasienController;
use App\Http\Controllers\Antrian\Table\VideoController;
use App\Models\MWLWL;

// Auth::routes();  
//Language Translation
Route::get('index/{locale}', [HomeController::class, 'lang']);
Route::post('/update-profile/{id}', [HomeController::class, 'updateProfile'])->name('updateProfile');
Route::post('/update-password/{id}', [HomeController::class, 'updatePassword'])->name('updatePassword');
// Route::get('{any}', [HomeController::class, 'index'])->name('index');


Route::get('/', [HomeController::class, 'portal']);

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Password Reset Routes
Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('password.update');
Route::post('/forgot-password', [AuthController::class, 'sendResetLink']);
Route::get('/reset-password/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'resetPassword']);

Route::get('/home', [HomeController::class, 'home'])->middleware('auth')->name('home');


// UNTUK GUEST TANPA LOGIN
Route::get('dashboard/radiology', [RadiologyController::class, 'index'])->name('radiology');
Route::get('dashboard/bed', [BedController::class, 'list'])->name('dashboard.bed');


// MODUL BED
Route::prefix('bed')->middleware('auth')->group(function () {
    Route::get('list', [BedController::class, 'list']);
    
});

// MODUL ANTRIAN
Route::resource('videos', VideoController::class)->middleware('auth');
Route::prefix('antrian')->middleware('auth')->group(function () {
    // Route::post('addvideo', [VideoController::class, 'store']);
    Route::get('dashboard', [RadiologyController::class, 'dashboard']);
    Route::get('dashboard/tabel/pasien', [PasienController::class, 'index'])->name('pasien');
    Route::get('dashboard/tabel/dokter', [DokterController::class, 'index'])->name('dokter');
    Route::get('dashboard/tabel/video', [VideoController::class, 'index'])->name('video');
    Route::get('search', [PasienController::class, 'searchPatient']);

});


