<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\TicketController;
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

Route::get('/', function () {
    return redirect()->route('application.index');
    // return view('welcome');
});

// Auth::routes();
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');


// 申込フォーム
Route::get('/application', [ApplicationController::class, 'index'])->name('application.index');
Route::post('/application', [ApplicationController::class, 'store'])->name('application.store');
Route::get('/application/{uid}', [ApplicationController::class, 'show'])->name('application.show');

// 管理者用画面
Route::get('admin/tickets', [TicketController::class, 'index'])->name('tickets.index');
Route::post('admin/tickets/{id}', [TicketController::class, 'enter'])->name('tickets.enter');
Route::delete('admin/tickets/{id}', [TicketController::class, 'destroy'])->name('tickets.destroy');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
