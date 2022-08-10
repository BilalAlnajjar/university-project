<?php

use App\Http\Controllers\Api\AnswerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('answer/{question_id}', [AnswerController::class , 'index'])->name('api.answer.index');
Route::get('answer/show/{id}', [AnswerController::class , 'show'])->name('api.answer.show');
Route::post('answer', [AnswerController::class , 'store'])->name('api.answer.post');
Route::put('answer/update/{id}', [AnswerController::class , 'update'])->name('api.answer.update');
Route::delete('answer/{id}', [AnswerController::class , 'destroy'])->name('api.answer.destroy');

//Route::middleware('auth:sanctum')->group();