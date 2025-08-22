<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

Route::middleware(['auth', 'role:admin|headmaster|professor'])->group(function () {
    Route::get('/students', [StudentController::class, 'index'])->name('students.index');
    Route::get('/students/add', [StudentController::class, 'add'])->name('students.add');
    Route::get('/students/{student}/pdf', [StudentController::class, 'exportPdf'])->name('students.exportPdf');
    Route::get('/students/{student}/remove', [StudentController::class, 'remove'])->name('students.remove');
    Route::get('students/{student}/edit', [StudentController::class, 'edit'])->name('students.edit');

    Route::post('/students', [StudentController::class, 'store'])->name('students.store');
    Route::put('/students/{student}', [StudentController::class, 'update'])->name('students.update');
    Route::delete('/students/{student}', [StudentController::class, 'delete'])->name('students.delete');
});
