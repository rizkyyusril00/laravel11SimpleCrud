<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('users');
// });

Route::get('/', [UserController::class, 'loadAllUsers']);
Route::get('/add/user', [UserController::class, 'loadAllUserForm']);
Route::post('/add/user', [UserController::class, 'AddUser'])->name('AddUser');
Route::get('/update/{id}', [UserController::class, 'loadEditForm']);
Route::post('/update/user', [UserController::class, 'EditUser'])->name('EditUser');
Route::get('/delete/{id}', [UserController::class, 'deleteUser']);
