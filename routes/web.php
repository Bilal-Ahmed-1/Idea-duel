<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BattleController;
use App\Http\Controllers\IdeaController;
use App\Http\Controllers\VoteController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;

require __DIR__.'/auth.php';

Route::get('/', [BattleController::class,'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/battles', [BattleController::class,'index'])->name('battles.index');
Route::get('/battles/create', [BattleController::class,'create'])->middleware('auth')->name('battles.create');
Route::post('/battles', [BattleController::class,'store'])->middleware('auth')->name('battles.store');
Route::get('/battles/{battle}', [BattleController::class,'show'])->name('battles.show');

Route::get('/battles/{battle}/ideas/create', [IdeaController::class,'create'])->middleware('auth')->name('ideas.create');
Route::post('/battles/{battle}/ideas', [IdeaController::class,'store'])->middleware('auth')->name('ideas.store');

Route::post('/ideas/{idea}/vote', [VoteController::class,'store'])->middleware('auth')->name('ideas.vote');

Route::post('/ideas/{idea}/comments', [CommentController::class,'store'])->middleware('auth')->name('ideas.comment');

Route::get('/dashboard', function () {
    return redirect()->route('battles.create');
})->name('dashboard');

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect('/');
})->name('logout');