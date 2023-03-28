<?php

use App\Http\Controllers\Auth\LoginUserController;
use App\Http\Controllers\Auth\RegisterUserController;
use App\Http\Controllers\RecoveryPasswordController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ToDoController;
use App\Http\Controllers\UserController;

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

Route::middleware("guest")->prefix("/authorize")->group(function () {
    Route::get("/", [LoginUserController::class, "index"])
        ->name("authorize.page");
    Route::get("/recovery", [LoginUserController::class, "recovery"])
        ->name("authorize.recovery");
    Route::get("/forgot_password", [RecoveryPasswordController::class, "store"])
        ->name("authorize.forgotPassword");
    Route::post("/forgot_password", [RecoveryPasswordController::class, "changePassword"])
        ->name('authorize.changePassword');
    Route::post("/recovery", [LoginUserController::class, "sendRecoveryMessage"])
        ->name("authorize.sendRecoveryMessage");
    Route::post("/", [LoginUserController::class, "store"])
        ->name("authorize.in");
});

Route::get("/logout", [LoginUserController::class, "destroy"])
    ->middleware("auth")
    ->name("logout");

Route::middleware("guest")->prefix("/register")->group(function () {
    Route::get("/", [RegisterUserController::class, "index"])
        ->name("register.page");
    Route::post("/new", [RegisterUserController::class, "store"])
        ->name("register.new");
});

Route::prefix("/email")->group(function () {
    Route::post('/verification-notification', [RegisterUserController::class, "sendEmailAgain"])
        ->middleware(['auth', 'throttle:6,1'])
        ->name('verification.send');
    Route::get('/verify', [RegisterUserController::class, "verify"])
        ->middleware('auth')
        ->name('verification.notice');
    Route::get('/verify/{id}/{hash}', [RegisterUserController::class, "verifyEmail"])
        ->middleware(['auth', 'signed'])
        ->name("verification.verify");
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::prefix('/profile')->group(function () {
        Route::get('/{user_id}', [UserController::class, 'index'])->name('profile');
    });
    Route::get('/', [ToDoController::class, 'getAllTasks'])->name('home');
    Route::post('/new_tag_item', [ToDoController::class, 'addNewTagItem']);
    Route::post('/create_new_task', [ToDoController::class, 'createItem']);
    Route::get('/check_task_tags', [ToDoController::class, 'checkIssetTagItem']);
    Route::post('/start_process_task', [ToDoController::class, 'startProcessTask']);
    Route::post('/finish_process_task', [ToDoController::class, 'finishProcessTask']);
});