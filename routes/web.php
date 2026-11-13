<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{AuthController,DashboardController,CompetitionController,NotificationController,ProfileController,HomeController};
Route::get('/',[HomeController::class,'index'])->name('welcome');
Route::get('/lomba',[CompetitionController::class,'index'])->name('competitions.index');
Route::get('/lomba/{competition}',[CompetitionController::class,'show'])->name('competitions.show');
Route::post('/lomba/{competition}/favorit',[CompetitionController::class,'toggleFavorite'])->name('competitions.favorite');
Route::post('/lomba/{competition}/daftar',[CompetitionController::class,'register'])->name('competitions.register');
Route::middleware('guest')->group(function(){Route::get('/login',[AuthController::class,'showLogin'])->name('login');Route::post('/login',[AuthController::class,'login'])->name('login.store');Route::get('/register',[AuthController::class,'showRegister'])->name('register');Route::post('/register',[AuthController::class,'register'])->name('register.store');Route::get('/forgot-password',[AuthController::class,'showForgotPassword'])->name('password.request');});
Route::middleware('auth')->group(function(){Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');Route::get('/notifikasi',[NotificationController::class,'index'])->name('notifications.index');Route::post('/notifikasi/{notification}/read',[NotificationController::class,'markRead'])->name('notifications.read');Route::get('/profil',[ProfileController::class,'show'])->name('profile.show');Route::get('/profil/data-akun',[ProfileController::class,'edit'])->name('profile.edit');Route::put('/profil/data-akun',[ProfileController::class,'update'])->name('profile.update');Route::post('/logout',[AuthController::class,'logout'])->name('logout');});
