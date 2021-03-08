<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ComplaintCategoryController;
use App\Http\Controllers\ComplaintChannelController;
use App\Http\Controllers\ComplaintFormController;
use App\Http\Controllers\ComplaintTypeController;
use App\Http\Controllers\ClinicController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;

require __DIR__.'/auth.php';

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('user')->middleware(['auth'])->group(function () {

    Route::get('', [UserController::class, 'index'])->name('users.index');
    Route::get('create', [UserController::class, 'create'])->name('users.create');
    Route::get('delete/{user}', [UserController::class, 'delete'])->name('users.delete');
    Route::get('edit/{user}', [UserController::class, 'edit'])->name('users.edit');
    Route::post('store', [UserController::class, 'store'])->name('users.store');
    Route::put('update/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('destroy/{user}', [UserController::class, 'destroy'])->name('users.destroy');
});

Route::group(['prefix' => 'roles', 'middleware' => []], function () {

    Route::get('', [RolesController::class, 'index'])->name('roles.index');
    Route::get('create', [RolesController::class, 'create'])->name('roles.create');
    Route::get('delete/{roles}', [RolesController::class, 'delete'])->name('roles.delete');
    Route::get('edit/{roles}', [RolesController::class, 'edit'])->name('roles.edit');
    Route::post('store', [RolesController::class, 'store'])->name('roles.store');
    Route::put('update/{roles}', [RolesController::class, 'update'])->name('roles.update');
    Route::delete('destroy/{roles}', [RolesController::class, 'destroy'])->name('roles.destroy');

});

Route::prefix('clinic')->middleware(['auth'])->group(function () {

    Route::get('', [ClinicController::class, 'index'])->name('clinics.index');
    Route::get('create', [ClinicController::class, 'create'])->name('clinics.create');
    Route::get('delete/{clinic}', [ClinicController::class, 'delete'])->name('clinics.delete');
    Route::get('edit/{clinic}', [ClinicController::class, 'edit'])->name('clinics.edit');
    Route::post('store', [ClinicController::class, 'store'])->name('clinics.store');
    Route::put('update/{clinic}', [ClinicController::class, 'update'])->name('clinics.update');
    Route::delete('destroy/{clinic}', [ClinicController::class, 'destroy'])->name('clinics.destroy');
});

Route::prefix('complaint-category')->middleware(['auth', 'admin'])->group(function () {

    Route::get('', [ComplaintCategoryController::class, 'index'])->name('complaint-category.index');
    Route::get('create', [ComplaintCategoryController::class, 'create'])->name('complaint-category.create');
    Route::get('delete/{complaint}', [ComplaintCategoryController::class, 'delete'])->name('complaint-category.delete');
    Route::get('edit/{complaint}', [ComplaintCategoryController::class, 'edit'])->name('complaint-category.edit');
    Route::post('store', [ComplaintCategoryController::class, 'store'])->name('complaint-category.store');
    Route::put('update/{complaint}', [ComplaintCategoryController::class, 'update'])->name('complaint-category.update');
    Route::delete('destroy/{complaint}', [ComplaintCategoryController::class, 'destroy'])->name('complaint-category.destroy');
});

Route::prefix('complaint-type')->middleware(['auth', 'admin'])->group(function () {

    Route::get('', [ComplaintTypeController::class, 'index'])->name('complaint-type.index');
    Route::get('create', [ComplaintTypeController::class, 'create'])->name('complaint-type.create');
    Route::get('delete/{type}', [ComplaintTypeController::class, 'delete'])->name('complaint-type.delete');
    Route::get('edit/{type}', [ComplaintTypeController::class, 'edit'])->name('complaint-type.edit');
    Route::post('store', [ComplaintTypeController::class, 'store'])->name('complaint-type.store');
    Route::put('update/{type}', [ComplaintTypeController::class, 'update'])->name('complaint-type.update');
    Route::delete('destroy/{type}', [ComplaintTypeController::class, 'destroy'])->name('complaint-type.destroy');
});

Route::prefix('complaint-channel')->middleware(['auth', 'admin'])->group(function () {

    Route::get('', [ComplaintChannelController::class, 'index'])->name('complaint-channel.index');
    Route::get('create', [ComplaintChannelController::class, 'create'])->name('complaint-channel.create');
    Route::get('delete/{channel}', [ComplaintChannelController::class, 'delete'])->name('complaint-channel.delete');
    Route::get('edit/{channel}', [ComplaintChannelController::class, 'edit'])->name('complaint-channel.edit');
    Route::post('store', [ComplaintChannelController::class, 'store'])->name('complaint-channel.store');
    Route::put('update/{channel}', [ComplaintChannelController::class, 'update'])->name('complaint-channel.update');
    Route::delete('destroy/{channel}', [ComplaintChannelController::class, 'destroy'])->name('complaint-channel.destroy');
});

Route::prefix('location')->middleware(['auth', 'admin'])->group(function () {

    Route::get('', [LocationController::class, 'index'])->name('location.index');
    Route::get('create', [LocationController::class, 'create'])->name('location.create');
    Route::get('delete/{location}', [LocationController::class, 'delete'])->name('location.delete');
    Route::get('edit/{location}', [LocationController::class, 'edit'])->name('location.edit');
    Route::post('store', [LocationController::class, 'store'])->name('location.store');
    Route::put('update/{location}', [LocationController::class, 'update'])->name('location.update');
    Route::delete('destroy/{location}', [LocationController::class, 'destroy'])->name('location.destroy');
});


Route::get('form-sent', [ComplaintFormController::class, 'sent'])->name('complaint-form.sent');

Route::get('complaint-form/manage', [ComplaintFormController::class, 'index'])
    ->middleware(['auth'])->name('complaint-form.manage');

Route::get('complaint-form/create', [ComplaintFormController::class, 'create'])->name('complaint-form.create');

Route::prefix('complaint-form')->middleware(['auth', 'admin'])->group(function () {

    Route::get('delete/{form}', [ComplaintFormController::class, 'delete'])->name('complaint-form.delete');
    Route::get('edit/{form}', [ComplaintFormController::class, 'edit'])->name('complaint-form.edit');
    Route::post('store', [ComplaintFormController::class, 'store'])->name('complaint-form.store');
    Route::put('update/{form}', [ComplaintFormController::class, 'update'])->name('complaint-form.update');
    Route::delete('destroy/{form}', [ComplaintFormController::class, 'destroy'])->name('complaint-form.destroy');
});

