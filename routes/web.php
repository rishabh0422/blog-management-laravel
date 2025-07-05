<?php

use App\Http\Controllers\GuestController;
use App\Http\Controllers\ProfileController;

use App\Models\Post;
use Illuminate\Support\Facades\Route;

Route::get('/',[GuestController::class,'index']);
Route::get('/blog/{slug}',[GuestController::class,'blog']);

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});



require __DIR__ . '/auth.php';
