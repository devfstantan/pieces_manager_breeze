<?php

use App\Http\Controllers\Admin\FournisseurController as AdminFournsseurController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Vendeur\FournisseurController as VendeurFournisseurController;

use App\Http\Controllers\ProfileController;
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
});

Route::prefix('admin')->middleware('admin')->name("admin.")->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');
    Route::resource('fournisseurs',AdminFournsseurController::class);

    Route::resource('users', AdminUserController::class);
});

Route::prefix('fournisseur')->middleware('fournisseur')->name("fournisseur.")->group(function () {
    Route::get('/dashboard', function () {
        return view('fournisseur.dashboard');
    })->name('dashboard');

});

Route::prefix('vendeur')->middleware('vendeur')->name("vendeur.")->group(function () {
    Route::get('/dashboard', function () {
        return view('vendeur.dashboard');
    })->name('dashboard');
    Route::resource('fournisseurs',VendeurFournisseurController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
