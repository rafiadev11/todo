<?php

    use App\Http\Controllers\Admin\UsersController;
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
        Route::post('todo', [TodoController::class, 'store'])->name('todo.store');
        Route::get('/todos', [TodoController::class, 'getItems']);
        Route::post('/mark-as-complete', [TodoController::class, 'markAsComplete'])->name('todo.complete');
        Route::post('/delete', [TodoController::class, 'deleteItem'])->name('todo.delete');
    });
    Route::group(['middleware' => ['auth', 'isAdmin']], function () {
        Route::get('/admin', [UsersController::class, 'index'])->name('users');
        Route::get('/admin/{id}/todos', [UsersController::class, 'todos'])->name('user.todos');
    });

