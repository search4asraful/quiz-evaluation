<?php

use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\TestController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Student\ExamController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware(['auth','admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('users',[UserController::class,'index'])->name('users.index');
    Route::get('users/{user}/edit',[UserController::class,'edit'])->name('users.edit');
    Route::patch('users/{user}/update',[UserController::class,'update'])->name('users.update');
    Route::delete('users/{user}/destroy',[UserController::class,'destroy'])->name('users.destroy');
    
    Route::resource('tests', TestController::class);

    Route::get('tests/{test}/questions',[QuestionController::class,'index'])->name('tests.questions.index');
    Route::post('tests/{test}/questions',[QuestionController::class,'store'])->name('tests.questions.store');
    Route::delete('tests/{test}/questions/{question}',[QuestionController::class,'destroy'])->name('tests.questions.destroy');
    Route::get('tests/{test}/questions/{question}/edit', [QuestionController::class, 'edit'])->name('tests.questions.edit');
    Route::put('tests/{test}/questions/{question}', [QuestionController::class, 'update'])->name('tests.questions.update');

    Route::get('tests/{test}/submissions',[TestController::class,'submissions'])->name('tests.submissions.index');
    Route::get('/result/{submission}', [ExamController::class,'result'])->name('tests.result');
});

Route::middleware(['auth','student'])->prefix('student')->name('student.')->group(function () {
    Route::get('/tests', [ExamController::class,'index'])->name('tests.index');
    Route::get('/tests/{test}', [ExamController::class,'show'])->name('tests.show');
    Route::post('/tests/{test}/submit', [ExamController::class,'submit'])->name('tests.submit');
    Route::get('/result/{submission}', [ExamController::class,'result'])->name('tests.result');
});
