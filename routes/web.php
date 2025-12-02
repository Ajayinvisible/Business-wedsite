<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\AboutController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\Backend\AppController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Backend\ClarifiesController;
use App\Http\Controllers\Backend\ConnectController;
use App\Http\Controllers\Backend\ContactController;
use App\Http\Controllers\Backend\FaqController;
use App\Http\Controllers\Backend\FinancialController;
use App\Http\Controllers\Backend\HomeController;
use App\Http\Controllers\Backend\ReviewController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\TeamController;
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


    Route::controller(ConnectController::class)->group(function () {
        Route::get('all/connect', 'AllConnect')->name('all.connect');
        Route::get('add/connect', 'AddConnect')->name('add.connect');
        Route::post('store/connect', 'StoreConnect')->name('store.connect');
        Route::get('edit/{id}/connect', 'EditConnect')->name('edit.connect');
        Route::put('update/{id}/connect', 'UpdateConnect')->name('update.connect');
        Route::get('delete/{id}/connect', 'DeleteConnect')->name('delete.connect');

        Route::post('edit-connect/{id}', 'EditConnectInline');
    });


    Route::controller(FaqController::class)->group(function () {
        Route::get('all/faqs', 'AllFaqs')->name('all.faqs');
        Route::get('add/faqs', 'AddFaqs')->name('add.faqs');
        Route::post('store/faqs', 'StoreFaqs')->name('store.faqs');
        Route::get('edit/{id}/faqs', 'EditFaqs')->name('edit.faqs');
        Route::put('update/{id}/faqs', 'UpdateFaqs')->name('update.faqs');
        Route::get('delete/{id}/faqs', 'DeleteFaqs')->name('delete.faqs');
    });


    Route::controller(AppController::class)->group(function () {
        Route::post('edit-app/{id}', 'EditAppInline');
        Route::post('upload-app-image/{id}', 'UploadAppImage');
    });


    Route::controller(TeamController::class)->group(function () {
        Route::get('all/team', 'AllTeam')->name('all.team');
        Route::get('add/team', 'AddTeam')->name('add.team');
        Route::post('store/team', 'StoreTeam')->name('store.team');
        Route::get('edit/{id}/team', 'EditTeam')->name('edit.team');
        Route::put('update/{id}/team', 'UpdateTeam')->name('update.team');
        Route::get('delete/{id}/team', 'DeleteTeam')->name('delete.team');
    });

    Route::controller(AboutController::class)->group(function () {
        Route::get('get/about', 'GetAbout')->name('get.about');
        Route::put('update/{id}/about', 'UpdateAbout')->name('update.about');
        Route::post('edit-about/{id}', 'EditAbout');
    });

    Route::controller(BlogController::class)->group(function () {
        Route::get('all/blog/category', 'AllBlogCategory')->name('all.blog.category');
        Route::get('add/blog/category', 'AddBlogCategory')->name('add.blog.category');
        Route::post('store/blog/category', 'StoreBlogCategory')->name('store.blog.category');
        Route::get('edit/{id}/blog/category', 'EditBlogCategory')->name('edit.blog.category');
        Route::put('update/blog/category', 'UpdateBlogCategory')->name('update.blog.category');
        Route::get('delete/{id}/blog/category', 'DeleteBlogCategory')->name('delete.blog.category');
    });


    Route::controller(BlogController::class)->group(function () {
        Route::get('all/blog', 'AllBlog')->name('all.blog');
        Route::get('add/blog', 'AddBlog')->name('add.blog');
        Route::post('store/blog', 'StoreBlog')->name('store.blog');
        Route::get('edit/{id}/blog', 'EditBlog')->name('edit.blog');
        Route::put('update/{id}/blog', 'UpdateBlog')->name('update.blog');
        Route::get('delete/{id}/blog', 'DeleteBlog')->name('delete.blog');
    });

    Route::controller(ContactController::class)->group(function () {
        Route::get('contact/all/message', 'ContactMessage')->name('all.contact.message');
        Route::get('contact/{id}/show', 'ShowMessage')->name('show.message');
        Route::get('contact/{id}/message', 'DeleteMessage')->name('delete.message');
    });
});

Route::get('/team', [FrontendController::class, 'OurTeam'])->name('our.team');
Route::get('/about-us', [FrontendController::class, 'AboutUs'])->name('about.us');
Route::get('/blog', [FrontendController::class, 'BlogPage'])->name('blog.page');
Route::get('/blog/details/{slug}', [FrontendController::class, 'BlogDetails']);
Route::get('/blog/category/{slug}', [FrontendController::class, 'blogCategoryPage'])->name('blog.category');
Route::get('/contact-us', [FrontendController::class, 'ContactUs'])->name('contact.us');
Route::post('/contact/message',[FrontendController::class, 'ContactMessage'])->name('contact.message');