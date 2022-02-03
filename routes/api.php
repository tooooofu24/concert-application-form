<?php

use App\Http\Controllers\ApiCheckEmailUniqueController;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\ApiEnterController;
use App\Http\Controllers\ApiTicketController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('check-email', [ApiController::class, 'checkEmail']);
Route::get('get-address', [ApiController::class, 'getAddress']);
Route::post('tickets/enter/{uid}', ApiEnterController::class);
