<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\AnswerController;

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

Route::get('/', [QuestionController::class, 'index']);

Route::get('/newQuestion', function () {
    return view('create_question');
});

Route::post('/insertQuestion', [QuestionController::class, 'createQuestion'])->name('insertQuestion');
Route::post('/deleteQuestion', [QuestionController::class, 'deleteQuestion'])->name('deleteQuestion');
Route::get('/updateQuestion/{id}', [QuestionController::class, 'updateQuestion'])->name('updateQuestion');
Route::post('/listAnswers', [QuestionController::class, 'listAnswers'])->name('listAnswers');
Route::post('/createAnswer', [AnswerController::class, 'createAnswer'])->name('createAnswer');
Route::post('/deleteAnswer', [AnswerController::class, 'deleteAnswer'])->name('deleteAnswer');
Route::get('/updateAnswer/{id}', [AnswerController::class, 'updateAnswer'])->name('updateAnswer');
Route::post('/likeHandle', [AnswerController::class, 'dislikeAnswerAjax'])->name('likeHandle');