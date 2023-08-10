<?php

use App\Http\Controllers\AnimalController;
use App\Http\Controllers\AutomatedCountryEmailController;
use App\Http\Controllers\AutomatedEmailContactsController;
use App\Http\Controllers\AutomatedResponseController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ComplaintCategoryController;
use App\Http\Controllers\ComplaintChannelController;
use App\Http\Controllers\ComplaintFormController;
use App\Http\Controllers\ComplaintTypeController;
use App\Http\Controllers\ClinicController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\OutcomeOptionsController;
use App\Http\Controllers\OutcomeOptionsCategoriesController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserImportController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\SeverityController;
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

Route::group(['prefix' => 'roles', 'middleware' => ['auth', 'admin']], function () {

    Route::get('', [RolesController::class, 'index'])->name('roles.index');
    Route::get('create', [RolesController::class, 'create'])->name('roles.create');
    Route::get('delete/{roles}', [RolesController::class, 'delete'])->name('roles.delete');
    Route::get('edit/{roles}', [RolesController::class, 'edit'])->name('roles.edit');
    Route::post('store', [RolesController::class, 'store'])->name('roles.store');
    Route::put('update/{roles}', [RolesController::class, 'update'])->name('roles.update');
    Route::delete('destroy/{roles}', [RolesController::class, 'destroy'])->name('roles.destroy');

});

Route::group(['prefix' => 'animals', 'middleware' => ['auth', 'admin']], function () {

    Route::get('', [AnimalController::class, 'index'])->name('animals.index');
    Route::get('create', [AnimalController::class, 'create'])->name('animals.create');
    Route::get('delete/{item}', [AnimalController::class, 'delete'])->name('animals.delete');
    Route::get('edit/{item}', [AnimalController::class, 'edit'])->name('animals.edit');
    Route::post('store', [AnimalController::class, 'store'])->name('animals.store');
    Route::put('update/{item}', [AnimalController::class, 'update'])->name('animals.update');
    Route::delete('destroy/{item}', [AnimalController::class, 'destroy'])->name('animals.destroy');

});

Route::prefix('clinic')->middleware(['auth'])->group(function () {

    Route::get('', [ClinicController::class, 'index'])->name('clinics.index');
    Route::get('create', [ClinicController::class, 'create'])->name('clinics.create');
    Route::get('delete/{clinic}', [ClinicController::class, 'delete'])->name('clinics.delete');
    Route::get('edit/{clinic}', [ClinicController::class, 'edit'])->name('clinics.edit');
    Route::post('store', [ClinicController::class, 'store'])->name('clinics.store');
    Route::put('update/{clinic}', [ClinicController::class, 'update'])->name('clinics.update');
    Route::delete('destroy/{clinic}', [ClinicController::class, 'destroy'])->name('clinics.destroy');

    Route::get('export', [ClinicController::class, 'export'])->name('clinics.export');
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
Route::post('complaint-form/store', [ComplaintFormController::class, 'store'])->name('complaint-form.store');

Route::prefix('complaint-form')->middleware(['auth'])->group(function () {

    Route::get('export/',  [ComplaintFormController::class, 'export'])->name('complaint-form.export');
    Route::match(['GET', 'POST'], 'download/{form}',  [ComplaintFormController::class, 'download'])->name('complaint-form.download');
    Route::get('edit/{form}', [ComplaintFormController::class, 'edit'])->name('complaint-form.edit');
    Route::put('update/{form}', [ComplaintFormController::class, 'update'])->name('complaint-form.update');

});

Route::prefix('complaint-form')->middleware(['auth', 'admin'])->group(function () {

    Route::get('delete/{form}', [ComplaintFormController::class, 'delete'])->name('complaint-form.delete');
    Route::delete('destroy/{form}', [ComplaintFormController::class, 'destroy'])->name('complaint-form.destroy');

});

Route::prefix('automated-response')->middleware(['auth', 'admin'])->group(function () {

    Route::get('', [AutomatedResponseController::class, 'index'])->name('automated-response.index');
    Route::get('create', [AutomatedResponseController::class, 'create'])->name('automated-response.create');
    Route::get('delete/{response}', [AutomatedResponseController::class, 'delete'])->name('automated-response.delete');
    Route::get('edit/{response}', [AutomatedResponseController::class, 'edit'])->name('automated-response.edit');
    Route::post('store', [AutomatedResponseController::class, 'store'])->name('automated-response.store');
    Route::put('update/{response}', [AutomatedResponseController::class, 'update'])->name('automated-response.update');
    Route::delete('destroy/{response}', [AutomatedResponseController::class, 'destroy'])->name('automated-response.destroy');
});

Route::prefix('outcome-options')->middleware(['auth', 'admin'])->group(function () {

    Route::get('', [OutcomeOptionsController::class, 'index'])->name('outcome-options.index');
    Route::get('create', [OutcomeOptionsController::class, 'create'])->name('outcome-options.create');
    Route::get('delete/{option}', [OutcomeOptionsController::class, 'delete'])->name('outcome-options.delete');
    Route::get('edit/{option}', [OutcomeOptionsController::class, 'edit'])->name('outcome-options.edit');
    Route::post('store', [OutcomeOptionsController::class, 'store'])->name('outcome-options.store');
    Route::put('update/{option}', [OutcomeOptionsController::class, 'update'])->name('outcome-options.update');
    Route::delete('destroy/{option}', [OutcomeOptionsController::class, 'destroy'])->name('outcome-options.destroy');
});

Route::prefix('outcome-options-categories')->middleware(['auth', 'admin'])->group(function () {

    Route::get('', [OutcomeOptionsCategoriesController::class, 'index'])->name('outcome-options-categories.index');
    Route::get('create', [OutcomeOptionsCategoriesController::class, 'create'])->name('outcome-options-categories.create');
    Route::get('delete/{category}', [OutcomeOptionsCategoriesController::class, 'delete'])->name('outcome-options-categories.delete');
    Route::get('edit/{category}', [OutcomeOptionsCategoriesController::class, 'edit'])->name('outcome-options-categories.edit');
    Route::post('store', [OutcomeOptionsCategoriesController::class, 'store'])->name('outcome-options-categories.store');
    Route::put('update/{category}', [OutcomeOptionsCategoriesController::class, 'update'])->name('outcome-options-categories.update');
    Route::delete('destroy/{category}', [OutcomeOptionsCategoriesController::class, 'destroy'])->name('outcome-options-categories.destroy');
});

Route::prefix('user-import')->middleware(['auth', 'admin'])->group(function () {
    Route::get('', [UserImportController::class, 'index'])->name('user-import.index');
    Route::post('', [UserImportController::class, 'import'])->name('user-import.import');
});

Route::prefix('documents')->middleware(['auth', 'admin'])->group(function () {

    Route::delete('delete/{id}', [DocumentController::class, 'delete'])->name('document.delete');

});

Route::get('files/download/{name}', [FileController::class, 'download'])->name('file.download');

Route::prefix('files')->middleware(['auth', 'admin'])->group(function () {

    Route::get('', [FileController::class, 'index'])->name('file.index');
    Route::get('create', [FileController::class, 'create'])->name('file.create');
    Route::get('delete/{file}', [FileController::class, 'delete'])->name('file.delete');
    Route::get('edit/{file}', [FileController::class, 'edit'])->name('file.edit');
    Route::post('store', [FileController::class, 'store'])->name('file.store');
    Route::put('update/{file}', [FileController::class, 'update'])->name('file.update');
    Route::delete('destroy/{file}', [FileController::class, 'destroy'])->name('file.destroy');
});

Route::prefix('severity')->middleware(['auth', 'admin'])->group(function () {

    Route::get('', [SeverityController::class, 'index'])->name('severity.index');
    Route::get('create', [SeverityController::class, 'create'])->name('severity.create');
    Route::get('delete/{item}', [SeverityController::class, 'delete'])->name('severity.delete');
    Route::get('edit/{item}', [SeverityController::class, 'edit'])->name('severity.edit');
    Route::post('store', [SeverityController::class, 'store'])->name('severity.store');
    Route::put('update/{item}', [SeverityController::class, 'update'])->name('severity.update');
    Route::delete('destroy/{item}', [SeverityController::class, 'destroy'])->name('severity.destroy');
});

Route::prefix('automated-email-contacts')->middleware(['auth', 'admin'])->group(function () {

    Route::get('', [AutomatedEmailContactsController::class, 'index'])->name('automated-email-contacts.index');
    Route::get('create', [AutomatedEmailContactsController::class, 'create'])->name('automated-email-contacts.create');
    Route::get('delete/{response}', [AutomatedEmailContactsController::class, 'delete'])->name('automated-email-contacts.delete');
    Route::get('edit/{response}', [AutomatedEmailContactsController::class, 'edit'])->name('automated-email-contacts.edit');
    Route::post('store', [AutomatedEmailContactsController::class, 'store'])->name('automated-email-contacts.store');
    Route::put('update/{response}', [AutomatedEmailContactsController::class, 'update'])->name('automated-email-contacts.update');
    Route::delete('destroy/{response}', [AutomatedEmailContactsController::class, 'destroy'])->name('automated-email-contacts.destroy');
});

Route::prefix('automated-country-emails')->middleware(['auth', 'admin'])->group(function () {

    Route::get('', [AutomatedCountryEmailController::class, 'index'])->name('automated-country-emails.index');
    Route::get('create', [AutomatedCountryEmailController::class, 'create'])->name('automated-country-emails.create');
    Route::get('delete/{response}', [AutomatedCountryEmailController::class, 'delete'])->name('automated-country-emails.delete');
    Route::get('edit/{response}', [AutomatedCountryEmailController::class, 'edit'])->name('automated-country-emails.edit');
    Route::post('store', [AutomatedCountryEmailController::class, 'store'])->name('automated-country-emails.store');
    Route::put('update/{response}', [AutomatedCountryEmailController::class, 'update'])->name('automated-country-emails.update');
    Route::delete('destroy/{response}', [AutomatedCountryEmailController::class, 'destroy'])->name('automated-country-emails.destroy');
});

Route::view('operational_policy', 'operationalPolicy')->name('operational_policy');
Route::view('responding_to_review', 'respondingToReview')->name('responding_to_review');
