<?php

use App\Http\Controllers\MemberController;
use App\Http\Controllers\BannersController;
use App\Http\Controllers\MitraController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;
use App\Models\Attendance;
use App\Models\Permission;
use App\Models\User;

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('home', function () {
        return view('pages.dashboard');
    })->name('home');

    Route::resource('members', MemberController::class);
    Route::patch('members/{member}/verify', [MemberController::class, 'verify'])->name('members.verify');
    Route::resource('banners', BannersController::class);
    Route::resource('mitras', MitraController::class);
    Route::get('projects', [ProjectController::class, 'index'])->name('project');
    Route::get('projects/{id}', [ProjectController::class, 'show'])->name('view.project');
    Route::delete('projects/{id}', [ProjectController::class, 'destroy'])->name('del_project');
});

Route::get('/', function () {
    return view('pages.auth.auth-login');
})->middleware('guest');

Route::get('/baru', function () {
    return view('baru.pages.index');
})->name('baruz');

Route::get('/member', function () {
    return view('baru.pages.member');
})->name('memberz');

Route::get('/banner', function () {
    return view('baru.pages.banner');
})->name('bannerz');

Route::get('/project', function () {
    return view('baru.pages.project');
})->name('projectz');

Route::get('/mitra', function () {
    return view('baru.pages.mitra');
})->name('mitraz');

Route::get('/create-member', function () {
    return view('baru.pages.create');
})->name('create');


