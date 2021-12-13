<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SearchController;
use App\Http\Livewire\Vote;
use App\Models\Forum;
use App\Models\UserForum;
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

Route::get('/', [PostController::class, 'dashboard']);

Route::get('/dashboard', [PostController::class, 'dashboard'])->name('dashboard');

Route::resource('/posts', PostController::class)->middleware(['auth']);

Route::resource('/forums', ForumController::class)->middleware(['auth']);

Route::get('/my-posts', [PostController::class, 'personal'])->middleware(['auth'])->name('posts.personal');

Route::post('/forums/{forum}/join', [ForumController::class, 'join'])->middleware(['auth'])->name('userforum.join');
Route::post('/forums/{forum}/remove', [ForumController::class, 'remove'])->middleware(['auth'])->name('userforum.remove');

Route::get('/search', [SearchController::class, 'index'])->middleware(['auth'])->name('search.index');

require __DIR__.'/auth.php';
