<?php

use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\UserController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::name('api.')->middleware('auth:sanctum')->group(function () {
    Route::post('users/toggle-follow-user/{user}', [UserController::class, 'toggleFollowUser']);
    Route::post('users/accept-pending-request/{user}', [UserController::class, 'acceptPendingRequest']);
    Route::post('users/reject-pending-request/{user}', [UserController::class, 'rejectPendingRequest']);

    Route::apiResource('users', UserController::class);
    Route::apiResource('posts', PostController::class);
    Route::apiResource('comments', CommentController::class);
});

