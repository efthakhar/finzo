<?php

use App\Http\Controllers\Api\Category\IncomeCategoryController;
use App\Http\Controllers\Api\IncomeController;
use App\Http\Controllers\Api\User\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Database\Seeders\DevDemo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    echo 'hello welcome to invextry';
})->name('home');

// create demo site
Route::get('/demo', function (Request $reqest) {

    $seeder = new DevDemo();
    $seeder->run();

    return redirect('/login');
});

// All Auth Related Route
Route::get('/register', [RegisterController::class, 'registrationForm'])->name('registrationForm');
Route::post('/register', [RegisterController::class, 'register'])->name('registerUser');
Route::get('/login', [LoginController::class, 'loginForm'])->name('loginForm');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// Handling All Admin Routes
Route::get('/admin/{any?}', function () {
    if (Auth::check()) {
        return view('admin.app');
    }

    return redirect('login');
})->where('any', '.*')->name('admin');

// All route available only for authenticated users
Route::group(['middleware' => ['auth']], function () {

    // User
    Route::get('/api/users/authenticated-user', [UserController::class, 'getAuthenticatedUser']);

    // income
    Route::get('/api/income-categories', [IncomeCategoryController::class, 'getIncomeCategoryList']);

    // income
    Route::get('/api/incomes', [IncomeController::class, 'index']);
    // Route::get('/api/incomes/{id}', [IncomeController::class, 'show']);
    // Route::post('/apiincomeds', [IncomeController::class, 'store']);
    // Route::put('/api/incomes/{id}', [IncomeController::class, 'update']);
    Route::delete('/api/incomes/{id}', [IncomeController::class, 'delete']);

});
