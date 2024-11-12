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
    Route::get('/get/members', [LoginController::class, 'getAllMembers']);

    // Project routes
    Route::prefix('projects')->group(function () {
        // Manajemen Project
        Route::get('/', [ProjectControllerApi::class, 'index']);
        Route::post('/', [ProjectControllerApi::class, 'store']); // Buat project + list job

        // Manajemen Member
        Route::post('/{project}/members', [ProjectControllerApi::class, 'addMember']); // Tambah member ke project
        Route::get('/{project}/members', [ProjectControllerApi::class, 'getProjectMembers']); // Get semua member project
        Route::delete('/{project}/members/{userId}', [ProjectControllerApi::class, 'removeMember']); // Hapus member dari project

        // Manajemen Job Assignment
        Route::post('/{project}/assign-job', [ProjectControllerApi::class, 'assignJob']); // Assign job ke member

        // Progress Tracking
        Route::post('/{project}/progress', [ProjectControllerApi::class, 'updateProgress']); // Update progress job
        Route::get('/progress/{project}/{userId}', [ProjectControllerApi::class, 'calculateProgress']); // Hitung progress
    });

    Route::get('/banners', [BannersControllerApi::class,'getData']);
    Route::get('/mitras', [MitraControllerApi::class,'getData']);
    Route::post('/logout', [LoginController::class, 'logout']);
});
