<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\ClarifiesController;
use App\Http\Controllers\Backend\FinancialController;
use App\Http\Controllers\Backend\HomeController;
use App\Http\Controllers\Backend\ReviewController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\UsabilityController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home.index');
});

Route::get('/dashboard', function () {
    return view('admin.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
Route::post('/admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login');
Route::get('/verify', [AdminController::class, 'ShowVerification'])->name('custom.verification.form');
Route::post('/verify', [AdminController::class, 'VerificationVerify'])->name('custom.verification.verify');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::post('/profile/store', [AdminController::class, 'ProfileStore'])->name('profile.store');
    Route::post('/admin/password/update', [AdminController::class, 'PasswordUpdate'])->name('admin.password.update');
});

Route::middleware('auth')->group(function () {
    Route::controller(ReviewController::class)->group(function () {
        Route::get('all/review', 'AllReview')->name('all.review');
        Route::get('add/review', 'AddReview')->name('add.review');
        Route::post('store/review', 'StoreReview')->name('store.review');
        Route::get('edit/{id}/review', 'EditReview')->name('edit.review');
        Route::put('update/{id}/review', 'UpdateReview')->name('update.review');
        Route::get('delete/{id}/review', 'DeleteReview')->name('delete.review');
    });


    Route::controller(SliderController::class)->group(function () {
        Route::get('get/slider', 'GetSlider')->name('get.slider');
        Route::put('update/{id}/slider', 'UpdateSlider')->name('update.slider');
        Route::post('edit-slider/{id}', 'EditSlider');
        Route::post('edit-features/{id}', 'EditFeatures');
        Route::post('edit-review/{id}', 'EditReview');
        Route::post('edit-answer/{id}', 'EditAnswer');
    });


    Route::controller(HomeController::class)->group(function () {
        Route::get('all/feature', 'AllFeature')->name('all.feature');
        Route::get('add/feature', 'AddFeature')->name('add.feature');
        Route::post('store/feature', 'StoreFeature')->name('store.feature');
        Route::get('edit/{id}/feature', 'EditFeature')->name('edit.feature');
        Route::put('update/{id}/feature', 'UpdateFeature')->name('update.feature');
        Route::get('delete/{id}/feature', 'DeleteFeature')->name('delete.feature');
    });

    Route::controller(ClarifiesController::class)->group(function () {
        Route::get('get/clarifies', 'GetClarifies')->name('get.clarifies');
        Route::put('update/{id}/clarifies', 'UpdateClarifies')->name('update.clarifies');
        Route::post('edit-clarifies/{id}', 'EditClarifies');
    });

    Route::controller(FinancialController::class)->group(function () {
        Route::get('get/financial', 'GetFinancial')->name('get.financial');
        Route::put('update/{id}/financial', 'UpdateFinancial')->name('update.financial');
        Route::post('edit-financial/{id}', 'EditFinancial');
    });

    
    Route::controller(UsabilityController::class)->group(function () {
        Route::get('get/usability', 'GetUsability')->name('get.usability');
        Route::put('update/{id}/usability', 'UpdateUsability')->name('update.usability');
        Route::post('edit-usability/{id}', 'EditUsability');
    });
});
