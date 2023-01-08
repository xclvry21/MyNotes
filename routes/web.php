<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\UserController;
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
        Route::middleware(['admin'])->group(function () {
            Route::get('/register', 'create')->name('admin.register_form');
            Route::get('/dashboard', 'index')->name('admin.dashboard');
            Route::get('/logout', 'logout')->name('admin.logout');
            Route::get('/user_list', 'user_list')->name('user.list');
            Route::get('/user/show/{id}', 'show_user')->name('user.show');
            Route::get('/admin_list', 'admin_list')->name('admin.list');
            Route::get('/admin/show/{id}', 'show')->name('admin.show');
            Route::get('/admin/{id}', 'destroy')->name('admin.destroy');

            Route::get('/profile/edit', 'edit_profile')->name('admin.edit_profile');
            Route::put('/profile/update', 'update_profile')->name('admin.update_profile');
            Route::post('/register', 'store')->name('admin.register');
        });
        Route::get('/login', 'login_form')->name('admin_login_form');
        Route::post('/login', 'login')->name('admin.login');
    });
});

/**
 * ==================== USER ROUTE ====================
 */
Route::controller(UserController::class)->group(function () {
    Route::middleware(['auth', 'verified'])->group(function () {
        Route::get('/dashboard', 'index')->name('user.dashboard');
        Route::get('/logout', 'logout')->name('user.logout');
        Route::get('/profile/edit', 'edit_profile')->name('user.edit_profile');
        Route::get('/password/edit', 'edit_password')->name('user.edit_password');

        Route::put('/profile/update', 'update_profile')->name('user.update_profile');
        Route::put('/password/update', 'update_password')->name('user.update_password');
    });
    Route::get('/register', 'create')->name('user.register_form');
    Route::get('/login', 'login_form')->name('user.login_form');

    Route::post('/login', 'login')->name('user.login');
});

Route::controller(NoteController::class)->group(function () {
    Route::middleware(['auth', 'verified'])->group(function () {
        Route::get('/note', 'index')->name('note.index');
        // Route::get('/note/create', 'create')->name('note.create');
        Route::get('/note/trash', 'trash')->name('note.trash');
        Route::get('/note/archives', 'archives')->name('note.archives');
        Route::get('/note/{id}', 'destroy')->name('note.destroy');
        Route::get('/note/show/{id}', 'show')->name('note.show');
        Route::get('/note/edit/{id}', 'edit')->name('note.edit');
        Route::get('/note/archive/{id}', 'archive')->name('note.archive');
        Route::get('/note/delete/{id}', 'delete')->name('note.delete');
        Route::get('/note/restore/{id}', 'restore')->name('note.restore');
        Route::get('/note/unarchive/{id}', 'unarchive')->name('note.unarchive');

        Route::post('/note/store', 'store')->name('note.store');
        Route::put('/note/{id}', 'update')->name('note.update');
    });
});

Route::controller(TagController::class)->group(function () {
    Route::middleware(['auth', 'verified'])->group(function () {
        Route::get('/tag', 'index')->name('tag.index');
        // Route::get('/tag/create', 'create')->name('tag.create');
        Route::get('/tag/edit/{id}', 'edit')->name('tag.edit');
        Route::get('/tag/show/{id}', 'show')->name('tag.show');
        Route::get('/tag/{id}', 'destroy')->name('tag.destroy');

        Route::post('/tag/store', 'store')->name('tag.store');
        Route::put('/tag', 'update')->name('tag.update');
    });
});

require __DIR__ . '/auth.php';
