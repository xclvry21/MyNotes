<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/**
 * ==================== ADMIN ROUTE ====================
 */
Route::prefix('admin')->group(function () {
    Route::controller(AdminController::class)->group(function () {
        Route::get('/login', 'login_form')->name('admin_login_form');
        // Route::get('/register', 'create')->name('admin.register_form');
        Route::get('/dashboard', 'index')->name('admin.dashboard')->middleware('admin');
        Route::get('/logout', 'logout')->name('admin.logout');

        Route::post('/login', 'login')->name('admin.login');
        
        // Route::post('/register', 'store')->name('admin.register');
    });
});

require __DIR__ . '/auth.php';
