<?php

    use App\Http\Controllers\Auth\LoginController;
    use App\Http\Controllers\Auth\RegisterController;
    use App\Http\Controllers\TodoController;
    use Illuminate\Support\Facades\Route;

    Route::group(['middleware' => 'guest'], function () {
        Route::get('login', [LoginController::class, 'index'])->name('login');
        Route::post('login', [LoginController::class, 'login'])->name('loginUser');
        Route::get('register', [RegisterController::class, 'index'])->name('register');
        Route::post('register', [RegisterController::class, 'register'])->name('registerUser');
    });
    Route::group(['middleware' => 'auth'], function () {
        Route::post('logout', [LoginController::class, 'logout'])->name('logout');
        Route::get('/', [TodoController::class, 'index'])->name('todo');
        Route::post('todo',[TodoController::class, 'store']);
    });

