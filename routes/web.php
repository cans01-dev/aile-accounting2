<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CompanyBusinessController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\DisclosedAccountListController;
use App\Http\Controllers\DisclosedBusinessListController;
use App\Http\Controllers\RateController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ScopeController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\TermController;
use App\Http\Middleware\SupportLogin;
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

Route::middleware(['guest'])->group(function () {
    Route::view('/login', 'pages.login')->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware(['auth', SupportLogin::class])->group(function () {
    Route::prefix('users')->group(function () {
        Route::get('/{user}', function () {
            return 'user';
        });
    });

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::post('/change_term', [SessionController::class, 'change_term']);

    Route::get('/', function () {
        return redirect('/home');
    });
    
    Route::get('/home', function () {
        return view('pages.home');
    });

    Route::prefix('master')->group(function () {
        Route::resource('terms', TermController::class)->only([
            'index', 'store', 'update', 'destroy'
        ]);
        Route::resource('companies', CompanyController::class)->only([
            'index', 'store', 'update', 'destroy'
        ]);
        Route::resource('scopes', ScopeController::class)->only([
            'index', 'store', 'update', 'destroy'
        ]);
        Route::resource('categories', CategoryController::class)->only([
            'index', 'store', 'update', 'destroy'
        ]);
        Route::resource('accounts', AccountController::class)->only([
            'index', 'store', 'update', 'destroy'
        ]);
        Route::resource('disclosed_account_lists', DisclosedAccountListController::class)->only([
            'index', 'store', 'update', 'destroy'
        ]);
        Route::resource('currencies', CurrencyController::class)->only([
            'index', 'store', 'update', 'destroy'
        ]);
        Route::resource('rates', RateController::class)->only([
            'index', 'store', 'update', 'destroy'
        ]);
        Route::resource('businesses', BusinessController::class)->only([
            'index', 'store', 'update', 'destroy'
        ]);
        Route::resource('disclosed_business_lists', DisclosedBusinessListController::class)->only([
            'index', 'store', 'update', 'destroy'
        ]);
    });

    Route::prefix('package')->group(function () {
        // Route::
    });

    Route::prefix('management')->group(function () {
        Route::resource('users', UserController::class)->only([
            'index', 'store', 'update', 'destroy'
        ]);
        Route::resource('roles', RoleController::class)->only([
            'index', 'store', 'update', 'destroy'
        ]);
    });

    Route::prefix('admin')->group(function () {
        Route::resource('clients', ClientController::class)->only([
            'index', 'store', 'update', 'destroy'
        ]);

        Route::post('/change_support_login_client', [SessionController::class, 'change_support_login_client']);
    });
});

