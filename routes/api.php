<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\BannersControllerApi;
use App\Http\Controllers\Api\MitraControllerApi;
use App\Http\Controllers\Api\ProjectControllerApi;
use App\Http\Controllers\Api\FcmTokenController;

Route::group(['middleware'=>['guest']], function () {
    Route::post('/register', [RegisterController::class, 'register']);
    Route::post('/login', [LoginController::class, 'login']);
});

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/get/members', [LoginController::class, 'getAllMembers']);

    // Project routes
    Route::prefix('projects')->group(function () {
        // Manajemen Project
        Route::get('/', [ProjectControllerApi::class, 'index']);
        Route::post('/', [ProjectControllerApi::class, 'store']);

        // Get projects by status
        Route::get('/status/{status}', [ProjectControllerApi::class, 'getProjectsByStatus']);

        // Join Request Management
        Route::post('/{project}/join', [ProjectControllerApi::class, 'requestJoin']);
        Route::post('/{project}/join-requests/{joinRequest}', [ProjectControllerApi::class, 'handleJoinRequest']);
        Route::get('/{project}/pending-requests', [ProjectControllerApi::class, 'getPendingJoinRequests']);

        Route::get('/{project}/detail', [ProjectControllerApi::class, 'getProjectDetail']);

        // Progress & Job Management
        Route::post('/{project}/progress', [ProjectControllerApi::class, 'updateProgress']);
        Route::get('{project}/{userId}', [ProjectControllerApi::class, 'calculateProgress']);
    });

    Route::get('/banners', [BannersControllerApi::class,'getData']);
    Route::get('/mitras', [MitraControllerApi::class,'getData']);
    Route::post('/logout', [LoginController::class, 'logout']);

    // FCM Token route
    Route::post('/fcm-token', [FcmTokenController::class, 'updateToken']);

    // Notifications
    Route::get('/notifications/join-requests', [ProjectControllerApi::class, 'getJoinRequestNotifications']);
});
