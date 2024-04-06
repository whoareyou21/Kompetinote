<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CompetitionStudentController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ValidationController;
use App\Http\Controllers\DownloadFileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => ['guest']], function() {
    Route::get('/login', [LoginController::class, 'Index'])->name('login')->middleware('guest');
    Route::post('/login', [LoginController::class, 'Login']);

    Route::get('/register', [LoginController::class, 'Register'])->name('register')->middleware('guest');
    Route::post('/register', [LoginController::class, 'Create']);
});

Route::group(['middleware' => ['auth']], function() {
    Route::group(['middleware' => ['role.verify:biro']], function() {
        Route::get('/dashboard/settings', [SettingController::class, 'Index']);
        Route::get('/dashboard/settings/create', [SettingController::class, 'create']);
        Route::get('/dashboard/settings/{id}/edit', [SettingController::class, 'edit']);
        Route::post('/dashboard/settings', [SettingController::class, 'store']);
        Route::put('/dashboard/settings/{id}', [SettingController::class, 'update']);
        Route::delete('/dashboard/settings/{id}', [SettingController::class, 'destroy']);
        
        Route::get('/dashboard/users', [UserController::class, 'Index']);
        Route::get('/dashboard/users/create', [UserController::class, 'create']);
        Route::get('/dashboard/users/{id}/edit', [UserController::class, 'edit']);
        Route::post('/dashboard/users', [UserController::class, 'store']);
        Route::put('/dashboard/users/{id}', [UserController::class, 'update']);
        Route::delete('/dashboard/users/{id}', [UserController::class, 'destroy']);
    });

    Route::group(['middleware' => ['role.verify:biro|wr3|wd3|dosen']], function() {
        Route::get('/dashboard/validations/{id}/download', [ValidationController::class, 'DownloadFile']);
        Route::get('/dashboard/validations/{id}/download-form', [ValidationController::class, 'DownloadForm']);
        Route::get('/dashboard/download/reports', [DownloadFileController::class, 'DownloadFile']);
        Route::get('/dashboard/reports', [ValidationController::class, 'IndexReport'])->name('/dashboard/reports');
    });

    Route::group(['middleware' => ['role.verify:dosen|biro']], function() {
        Route::get('/dashboard/validations', [ValidationController::class, 'Index']);
        Route::get('/dashboard/validations/{id}/edit', [ValidationController::class, 'edit']);
        Route::put('/dashboard/validations/{id}', [ValidationController::class, 'update']);
        Route::put('/dashboard/validations/{id}/{status}', [ValidationController::class, 'UpdateStatus']);
        Route::delete('/dashboard/validations/{id}', [ValidationController::class, 'destroy']);
    });

    Route::group(['middleware' => ['role.verify:mahasiswa']], function() {
        Route::get('/dashboard/download/reports/student', [DownloadFileController::class, 'DownloadFileStudent']);
        Route::get('/dashboard/student/competition', [CompetitionStudentController::class, 'Index']);
        Route::get('/dashboard/student/competition/create', [CompetitionStudentController::class, 'create']);
        Route::get('/dashboard/student/competition/{id}/edit', [CompetitionStudentController::class, 'edit']);
        Route::post('/dashboard/student/competition', [CompetitionStudentController::class, 'store']);
        Route::put('/dashboard/student/competition/{id}', [CompetitionStudentController::class, 'update']);
        Route::delete('/dashboard/student/competition/{id}', [CompetitionStudentController::class, 'destroy']);
        
        Route::get('/dashboard/student/profile', [UserController::class, 'ShowProfile']);
        Route::put('/dashboard/student/profile', [UserController::class, 'UpdateProfile']);
    });

    Route::get('/', [HomeController::class, 'Index']);
    Route::post('/logout', [LoginController::class, 'Logout']);
});
