<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GymController;
use App\Http\Controllers\LicenseController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\NotifyController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\UpdateController;
use App\Http\Controllers\AppController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');


Route::group(['middleware' => ['auth']], function () {

Route::group(['middleware' => ['role:admin,supervisor']], function () {
    
    Route::get('/gyms/create', [GymController::class, 'create'])->name('gyms.create');
    Route::post('/gyms/store', [GymController::class, 'store'])->name('gyms.store');
    Route::get('/gyms/{id}', [GymController::class, 'show'])->name('gyms.show');
    Route::get('/gyms/edit/{id}', [GymController::class, 'edit'])->name('gyms.edit');
    Route::post('/gyms/update/{id}', [GymController::class, 'update'])->name('gyms.update');
    Route::get('/gyms/{id}/upload', [ImageController::class, 'create'])->name('gyms.image.create');
    Route::post('/gyms/{id}/upload', [ImageController::class, 'store'])->name('gyms.image.store');

   
//////////////////////////////////////////////////////////////////////////////////////////////
    Route::get('/gyms/{gym_id}/licenses/edit/{id}', [LicenseController::class, 'edit'])->name('licenses.edit');
    Route::post('/gyms/{gym_id}/licenses/update/{id}', [LicenseController::class, 'update'])->name('licenses.update');
//////////////////////////////////////////////////////////////////////////////////////////////
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

});

Route::group(['middleware' => ['role:admin,supervisor,sales']], function () {
    Route::get('/gyms', [GymController::class, 'index'])->name('gyms.index');
    Route::get('/gyms/{gym_id}/licenses/create', [LicenseController::class, 'create'])->name('licenses.create');
    Route::post('/gyms/{gym_id}/licenses/store', [LicenseController::class, 'store'])->name('licenses.store');
});

Route::group(['middleware' => ['role:admin']], function () {

Route::get('/plans', [PlanController::class, 'index'])->name('plans.index');

Route::get('/plans/create', [PlanController::class, 'create'])->name('plans.create');

Route::post('/plans/store', [PlanController::class, 'store'])->name('plans.store');

Route::get('/plans/{id}', [PlanController::class, 'show'])->name('plans.show');

Route::get('/plans/edit/{id}', [PlanController::class, 'edit'])->name('plans.edit');

Route::post('/plans/update/{id}', [PlanController::class, 'update'])->name('plans.update');

Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::post('/users/{user}/roles', [UserController::class, 'updateRoles'])->name('users.updateRoles');

Route::get('/gyms/{id}/notify/create', [NotifyController::class, 'createGymNotify'])->name('gyms.notify.create');
Route::post('/gyms/{id}/notify/store', [NotifyController::class, 'gymPlayers'])->name('gyms.notify.store');

Route::get('/notify', [NotifyController::class, 'createNotify'])->name('notify.create');
Route::post('/notify', [NotifyController::class, 'allPlayers'])->name('notify.store');



Route::get('upload', [UploadController::class, 'showUploadForm'])->name('upload.form');
Route::post('upload', [UploadController::class, 'uploadLargeFile'])->name('upload.large');

Route::get('/updates', [UpdateController::class, 'index'])->name('updates.index');
Route::get('/updates/create', [UpdateController::class, 'create'])->name('updates.create');
Route::post('/updates', [UpdateController::class, 'store'])->name('updates.store');
});
});
Auth::routes();

Route::get('/download/{filename}', function ($filename) {
    $path = storage_path('app/private/uploads/' . $filename);

    if (!File::exists($path)) {
        abort(404);
    }

    return response()->download($path);
});

Route::get('/app/desktop/updates', [UpdateController::class, 'getDesktopUpdateInfo']);
Route::get('/app/mobile/updates/{platform}', [UpdateController::class, 'getMobileUpdateInfo']);


Route::get('/app/privacy-policy', [AppController::class, 'privacy']);