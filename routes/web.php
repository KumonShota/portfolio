<?php

use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ProfileController;
use App\Models\Review;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FavoriteController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::group(['middleware' => ['auth']], function () {
    Route::get('/posts', [ReviewController::class, 'index']);
    Route::get('/', [ReviewController::class, 'index']);
    Route::get('/posts/create', [ReviewController::class, 'create']);
    Route::get('/posts', [ReviewController::class, 'store']);
    Route::post('/posts', [ReviewController::class, 'store'])->name('posts.store');
    Route::get('/posts/{post}', [ReviewController::class, 'show']);
    Route::get('/posts/{post}/edit', [ReviewController::class, 'edit']);
    Route::put('/posts/{post}', [ReviewController::class, 'update']);
    Route::delete('/poosts/{post})', [ReviewController::class, 'delete']);
    Route::get('/', [ReviewController::class, 'index'])->name('index')->middleware('auth');
    Route::middleware(['auth'])->group(function () {
        Route::post('/posts/{post}/favorite', [FavoriteController::class, 'store'])->name('reviews.favorite');
        Route::delete('/posts/{post}/favorite', [FavoriteController::class, 'destroy'])->name('reviews.unfavorite');
    });

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');
});
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
