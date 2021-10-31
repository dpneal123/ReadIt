<?php

use App\Http\Controllers\ForumController;
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
    return view('dashboard');
});

Route::resource('/posts', PostController::class)->middleware(['auth']);

Route::resource('/forums', ForumController::class)->middleware(['auth']);

Route::get('/dashboard', function () {
    return redirect('/');
})->name('dashboard');

require __DIR__.'/auth.php';
