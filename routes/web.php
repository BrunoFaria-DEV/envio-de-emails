<?php

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

Auth::routes(['register' => false]);

// Site
Route::get('/', [\App\Http\Controllers\Auth\LoginController::class, 'showLoginForm']);
Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/admin', [\App\Http\Controllers\Admin\HomeController::class, 'login'])->name('admin');

Route::get('/campanha', [\App\Http\Controllers\ShippingSyncController::class, 'read']);

// =========== Admin dashboard ===========
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function() {
  Route::get('/home', [\App\Http\Controllers\Admin\HomeController::class, 'index'])->name('home');
  // Route::get('/overview', [\App\Http\Controllers\Admin\HomeController::class, 'overview'])->name('overview');
  // Route::get('/pages_by_visits', [\App\Http\Controllers\Admin\HomeController::class, 'pages_by_visits'])->name('pages_by_visits');
  // Route::get('/history', [\App\Http\Controllers\Admin\HomeController::class, 'history'])->name('history');
  // Route::get('/visitor_return', [\App\Http\Controllers\Admin\HomeController::class, 'visitor_return'])->name('visitor_return');
  Route::post('/summernote/upload', [\App\Http\Controllers\Admin\HomeController::class, 'summernote_upload'])->name('summernote_upload');
  Route::get('/get_company_info', [\App\Http\Controllers\Admin\HomeController::class, 'get_company_info'])->name('get_company_info');

  // Audit
  Route::resource('/audit', \App\Http\Controllers\Admin\AuditController::class)->only([
    'index', 'show'
  ]);

    // Info
    Route::resource('/info', \App\Http\Controllers\Admin\InfoController::class)->only([
      'edit', 'update'
  ]);

  // Roles
  Route::resource('/roles', \App\Http\Controllers\Admin\RoleController::class);

  // States
  Route::get('/states/cities/{state}', [\App\Http\Controllers\Admin\StateController::class, 'cities'])->name('states.cities');

  // Users
  Route::resource('/users', \App\Http\Controllers\Admin\UserController::class);

  // Customers
  Route::resource('/customers', \App\Http\Controllers\Admin\CustomerController::class);

  // Customers
  Route::resource('/customer-accounts', \App\Http\Controllers\Admin\CustomerAccountController::class, [
    'names' => [
        'index' => 'customer_accounts.index',
        'create' => 'customer_accounts.create',
        'store' => 'customer_accounts.store',
        'edit' => 'customer_accounts.edit',
        'update' => 'customer_accounts.update',
        'destroy' => 'customer_accounts.destroy',
        'show' => 'customer_accounts.show'
    ]
  ]);

  // Shippings
  Route::get('/shippings/csv', [\App\Http\Controllers\Admin\ShippingController::class, 'csv'])->name('shippings.csv');
  Route::resource('/shippings', \App\Http\Controllers\Admin\ShippingController::class);

  // Contact
  Route::get('/contact/csv', [\App\Http\Controllers\Admin\ContactController::class, 'csv'])->name('contact.csv');
  Route::resource('/contact', \App\Http\Controllers\Admin\ContactController::class)->only([
    'index', 'show'
  ]);

});
