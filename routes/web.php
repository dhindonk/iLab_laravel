<?php

use App\Http\Controllers\MemberController;
use App\Http\Controllers\BannersController;
use App\Http\Controllers\MitraController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('home', function () {
        return view('pages.dashboard');
    })->name('home');

    Route::resource('members', MemberController::class);
    Route::patch('members/{member}/verify', [MemberController::class, 'verify'])->name('members.verify');
    Route::resource('banners', BannersController::class);
    Route::resource('mitras', MitraController::class);

    // Perbaiki route project
    Route::prefix('projects')->group(function () {
        Route::get('/', [ProjectController::class, 'index'])->name('project');
        Route::get('/{project}', [ProjectController::class, 'show'])->name('project.show');
        Route::delete('/{project}', [ProjectController::class, 'destroy'])->name('project.destroy');
    });
});

Route::get('/', function () {
    return view('pages.auth.auth-login');
})->middleware('guest');




