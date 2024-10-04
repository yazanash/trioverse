<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GymController;
use App\Http\Controllers\LicenseController;
use App\Http\Controllers\PlanController;
Route::get('/', function () {
    return view('inv');
});


Route::get('/gyms', [GymController::class, 'index'])->name('gyms.index');

Route::get('/gyms/create', [GymController::class, 'create'])->name('gyms.create');

Route::post('/gyms/store', [GymController::class, 'store'])->name('gyms.store');

Route::get('/gyms/{id}', [GymController::class, 'show'])->name('gyms.show');

Route::get('/gyms/edit/{id}', [GymController::class, 'edit'])->name('gyms.edit');

Route::post('/gyms/update/{id}', [GymController::class, 'update'])->name('gyms.update');
//////////////////////////////////////////////////////////////////////////////////////////////

Route::get('/gyms/{gym_id}/licenses/create', [LicenseController::class, 'create'])->name('licenses.create');
Route::post('/gyms/{gym_id}/licenses/store', [LicenseController::class, 'store'])->name('licenses.store');

Route::get('/gyms/{gym_id}/licenses/edit/{id}', [LicenseController::class, 'edit'])->name('licenses.edit');
Route::post('/gyms/{gym_id}/licenses/update/{id}', [LicenseController::class, 'update'])->name('licenses.update');

//////////////////////////////////////////////////////////////////////////////////////////////

Route::get('/plans', [PlanController::class, 'index'])->name('plans.index');

Route::get('/plans/create', [PlanController::class, 'create'])->name('plans.create');

Route::post('/plans/store', [PlanController::class, 'store'])->name('plans.store');

Route::get('/plans/{id}', [PlanController::class, 'show'])->name('plans.show');

Route::get('/plans/edit/{id}', [PlanController::class, 'edit'])->name('plans.edit');

Route::post('/plans/update/{id}', [PlanController::class, 'update'])->name('plans.update');



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
