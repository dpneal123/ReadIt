<?php

use App\Http\Controllers\PostController;
use App\Models\Forum;
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
    return view('welcome');
});

Route::resource('/posts', PostController::class);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/forums/{forum:slug}', function (Forum $forum) {
    return view('Posts.View', [
        'posts' => $forum->post->load(['forum', 'author']),
        'forums' => Forum::orderby('created_at', 'desc')->paginate(10)->where('active', 1)
    ]);
});

require __DIR__.'/auth.php';
