<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/login', [AuthController::class, 'loginPage'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/register', [AuthController::class, 'registrationPage'])->name('register');
Route::post('/register', [AuthController::class, 'registration'])->name('register');


// Admin Access
Route::middleware('checkUserRole:admin')->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::get('/profile', [AuthController::class, 'profile'])->name('admin.profile');
    // Add more routes as needed...
});

Route::middleware('checkUserRole:user')->prefix('users')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'userDashboard'])->name('user.dashboard');
    Route::get('/profile', [AuthController::class, 'profile'])->name('user.profile');
    // Add more routes as needed...
});

Route::get('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');

// Routes Handler Error
Route::fallback(function () {
    return response()->json([
        'success' => false,
        'message' => '404 Not Found'
    ], 404);
});
