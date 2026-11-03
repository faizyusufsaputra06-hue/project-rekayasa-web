
<?php

use App\Http\Controllers\AdminProjectController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\projectController;
use Illuminate\Support\Facades\Route;

// LOGIN
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/actionlogin', [LoginController::class, 'actionLogin'])->name('actionlogin');
Route::post('/logout', [LoginController::class, 'actionLogout'])->middleware('auth')->name('logout');

// HALAMAN PUBLIC
Route::get('/', function () {
    return view('page.home');
});

Route::get('/profile', [MahasiswaController::class, 'index']);

Route::get('/projects', [projectController::class, 'index'])->name('projects.index');
Route::get('/projects/{id}', [projectController::class, 'show'])->name('projects.show');

Route::get('/about', function () {
    return view('page.about');
});

// HALAMAN ADMIN
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {

    Route::get('/', function () {
        return view('admin.home');
    })->name('home');

    Route::resource('projects', AdminProjectController::class);

});
