<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// Login Routes
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [AuthController::class, 'login']);

// Registration Routes
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


/*
|--------------------------------------------------------------------------
| Protected Routes (Authenticated Users Only)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // 1. ROOT REDIRECT
    // If someone types http://127.0.0.1:8000/, send them to /dashboard
    Route::get('/', function () {
        return redirect()->route('dashboard');
    });

    // 2. THE DASHBOARD (Moved from / to /dashboard)
    Route::get('/dashboard', [NoteController::class, 'index'])->name('dashboard');

    // 3. PROFILE
    Route::get('/profile', function () {
        return view('notes.profile');
    })->name('profile');

    // 4. NOTE CRUD OPERATIONS
    Route::post('/notes', [NoteController::class, 'store'])->name('notes.store');
    Route::put('/notes/{note}', [NoteController::class, 'update'])->name('notes.update');
    Route::delete('/notes/{note}', [NoteController::class, 'destroy'])->name('notes.destroy');
});