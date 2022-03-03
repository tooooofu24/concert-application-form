<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\TicketController;
use App\Mail\InvitationMail;
use App\Mail\PreviousMail;
use App\Models\Ticket;
use Illuminate\Support\Facades\Mail;
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
Route::group(['prefix' => 'admin'], function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});

// 申込フォーム
Route::group(['as' => 'application.', 'prefix' => 'application'], function () {
    Route::get('/', [ApplicationController::class, 'index'])->name('index');
    Route::post('/', [ApplicationController::class, 'store'])->name('store');
    Route::get('tickets/{uid}', [ApplicationController::class, 'show'])->name('show');
    Route::get('/complete', [ApplicationController::class, 'complete'])->name('complete');
});

// 管理者用画面
Route::group(['middleware' => 'auth', 'prefix' => 'admin'], function () {
    Route::group(['prefix' => 'tickets', 'as' => 'tickets.'], function () {
        Route::get('/', [TicketController::class, 'index'])->name('index');
        Route::post('{id}', [TicketController::class, 'enter'])->name('enter');
        Route::delete('{id}', [TicketController::class, 'destroy'])->name('destroy');
        Route::put('{id}', [TicketController::class, 'update'])->name('update');
        Route::post('send-email/{id}', [TicketController::class, 'sendMail'])->name('send-mail');
        Route::post('/', [TicketController::class, 'store'])->name('store');
    });
    Route::get('how-to', function () {
        return view('admin.how-to');
    })->name('how-to');

    Route::get('qr-code', function () {
        return view('admin.qr-code');
    })->name('qr-code');

    Route::get('email-test', function () {
        $ticket = Ticket::find(1);
        $mail = new PreviousMail($ticket);
        return $mail->build();
    });

    // サンプルのチケット画面
    Route::get('tickets/sample', function () {
        return view('application.ticket');
    })->name('tickets.sample');
});

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
