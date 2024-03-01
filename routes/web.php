<?php

use App\Http\Controllers\Apps\PermissionManagementController;
use App\Http\Controllers\Apps\RoleManagementController;
use App\Http\Controllers\Apps\UserManagementController;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\backend\ProductController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmailTemplateController;
use Illuminate\Support\Facades\Route;

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

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/', [DashboardController::class, 'index']);

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/product', [ProductController::class, 'index'])->name('product');
    Route::get('/product/show/{product}', [ProductController::class, 'show'])->name('product-management.show');
    Route::get('/email-templates', [EmailTemplateController::class, 'index'])->name('email.templates');
    Route::get('/email-templates/create', [EmailTemplateController::class, 'create'])->name('email.templates.create');
    Route::post('/email-templates', [EmailTemplateController::class, 'store'])->name('email.templates.store');
    Route::get('/email-templates/show/{id}', [EmailTemplateController::class, 'show'])->name('email.templates.show');
    Route::get('/email-templates/delete/{id}', [EmailTemplateController::class,'delete'])->name('email-templates.delete');
    Route::get('/email-templates/edit/{id}', [EmailTemplateController::class,'edit'])->name('email-templates.edit');
    Route::post('/email-templates/update/{id}', [EmailTemplateController::class,'update'])->name('email-templates.update');


    Route::name('user-management.')->group(function () {
        Route::resource('/user-management/users', UserManagementController::class);
        Route::resource('/user-management/roles', RoleManagementController::class);
        Route::resource('/user-management/permissions', PermissionManagementController::class);
    });

});

Route::get('/error', function () {
    abort(500);
});

Route::get('/auth/redirect/{provider}', [SocialiteController::class, 'redirect']);

require __DIR__ . '/auth.php';
