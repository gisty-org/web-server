<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SummaryController;
use App\Http\Controllers\SnapshotController;
use App\Http\Controllers\UserController;


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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/register',[AuthController::class,'register']);

Route::post('/login',[AuthController::class,'login']);

Route::post('/request_otp',[AuthController::class,'requestOTP']);

Route::post('/reset_password',[AuthController::class,'resetPassword']);

Route::get('/summaries/{userId}',[SummaryController::class,'index']);

Route::post('/summaries/create',[SummaryController::class,'create']);

Route::post('/summaries/share',[SummaryController::class,'share']);

Route::delete('/summaries/{summaryId}', [SummaryController::class,'destroy']);

Route::delete('/summaries/{summaryId}/snapshots/{snapshotId}',[SnapshotController::class,'destroy']);

Route::get('/profile/{id}/edit',[UserController::class,'getProfile']);

Route::put('/profile/{id}',[UserController::class,'editProfile']);