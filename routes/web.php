<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RolesController;

require __DIR__.'/auth.php';

Auth::routes();

Route::get('', [App\Http\Controllers\HomeController::class, 'index']);

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'dashboard'])
->middleware(['auth'])->name('home');

// Route::middleware(['auth'])
//     ->group(['prefix' => 'roles'], functuion(){
//         Route::get('create', [Roles::class, 'create'])->name('routes.create');
//     });

Route::group(['prefix' => 'roles', 'middleware' => ['auth', 'admin']], function () {

    \Route::get('', [RolesController::class, 'index'])->name('roles.index');
    \Route::get('create', [RolesController::class, 'create'])->name('roles.create');
    \Route::get('edit/{roles}', [RolesController::class, 'edit'])->name('roles.edit');
    \Route::post('store', [RolesController::class, 'store'])->name('roles.store');
    \Route::put('update/{roles}', [RolesController::class, 'update'])->name('roles.update');

});

