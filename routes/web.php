<?php

use App\Http\Controllers\Tasks\TaskController;
use Illuminate\Support\Facades\Route;

use function Ramsey\Uuid\v1;

Route::get('/', function(){
    return view('dashboard');
})->name('dashboard');

Route::group(['prefix' => 'task', 'as' => 'task.'], function(){
    Route::get('index', [TaskController::class, 'index'])->name('index');
    Route::get('create', [TaskController::class, 'create'])->name('create');
    Route::post('store', [TaskController::class, 'store'])->name('store');
    Route::get('edit/{task_id}', [TaskController::class, 'edit'])->name('edit');
    Route::put('update/{task_id}', [TaskController::class, 'update'])->name('update');
    Route::delete('delete/{task_id}', [TaskController::class, 'destroy'])->name('destroy');
});

