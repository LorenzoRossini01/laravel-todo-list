<?php

use App\Http\Controllers\StepController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
  return view('home');
})->name('home');

Route::resource('tasks', TaskController::class);

Route::resource('steps', StepController::class);

Route::patch('/steps/{step}/completed', [StepController::class, 'updateCompleted'])->name('steps.update-completed');
Route::patch('/tasks/{task}/reset-steps', [StepController::class, 'resetCompleted'])->name('steps.reset');
