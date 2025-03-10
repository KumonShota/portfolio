<?php

use App\Http\Controllers\RegionController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\StoreController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| ここにアプリケーションのWebルートを登録します。
| これらのルートは RouteServiceProvider によってロードされ、
| すべて「web」ミドルウェアグループにアサインされます。
|
*/

Route::get('/', [ReviewController::class, 'index'])->name('index');

Route::group(['middleware' => ['auth']], function () {
    // レビュー関連のルート
    Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');
    Route::get('/reviews/create', [ReviewController::class, 'create'])->name('reviews.create');
    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::get('/reviews/{review}', [ReviewController::class, 'show'])->name('reviews.show');
    Route::get('/reviews/{review}/edit', [ReviewController::class, 'edit'])->name('reviews.edit');
    Route::put('/reviews/{review}', [ReviewController::class, 'update'])->name('reviews.update');
    Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
    Route::post('/reviews/{review}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy')->middleware('auth');
    Route::get('/stores', [StoreController::class, 'index'])->name('stores.index');


    // ユーザー詳細ページ
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');

    // フォロー・フォロワー機能
    Route::post('/users/{user}/follow', [FollowController::class, 'follow'])->name('users.follow');
    Route::post('/users/{user}/unfollow', [FollowController::class, 'unfollow'])->name('users.unfollow');

    //地方関連のルート
    Route::get('/regions', [RegionController::class, 'index'])->name('regions.index');
    Route::get('/regions/{region}', [RegionController::class, 'show'])->name('regions.show');


    // お気に入り機能のルート
    Route::post('/reviews/{review}/favorite', [FavoriteController::class, 'store'])->name('reviews.favorite');
    Route::post('/reviews/{review}/unfavorite', [FavoriteController::class, 'destroy'])->name('reviews.unfavorite');

    // ダッシュボード
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');
});

// プロフィール関連のルート
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
