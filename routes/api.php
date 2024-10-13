<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\BannersControllerApi;
use App\Http\Controllers\Api\MitraControllerApi;
use App\Http\Controllers\Api\ProjectControllerApi;

Route::group(['middleware'=>['guest']], function () {
    Route::post('/register', [RegisterController::class, 'register']);
    Route::post('/login', [LoginController::class, 'login']);
});

Route::group(['middleware' => ['auth:sanctum']], function () {

    // Route::get('/user', function (Request $request) {
    //     return $request->user();
    // });
    Route::get('/get/members', [LoginController::class, 'getAllMembers']);
    Route::get('/get/projects', [ProjectControllerApi::class, 'index']);
    Route::post('/create/projects', [ProjectControllerApi::class, 'store']);
    Route::post('/projects/{project}/progress', [ProjectControllerApi::class, 'updateProgress']);
    Route::get('/projects/progress/{project}/{userId}/', [ProjectControllerApi::class, 'calculateProgress']);

    Route::get('/banners', [BannersControllerApi::class,'getData']);
    Route::get('/mitras', [MitraControllerApi::class,'getData']);

    Route::post('/logout', [LoginController::class, 'logout']);

});
