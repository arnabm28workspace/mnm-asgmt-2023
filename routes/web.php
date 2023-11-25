<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BlogController;

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

/*Route::get('/', function () {
    return view('welcome');
});*/


Route::get('/', [HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::prefix('blogs')->name('blogs.')->group(function(){
        Route::get('list', [BlogController::class, 'index'])->name('list');
        Route::get('create', [BlogController::class, 'create'])->name('create');
        Route::post('store', [BlogController::class, 'store'])->name('store');
        Route::get('edit/{id}', [BlogController::class, 'edit'])->name('edit');
        Route::post('update/{id}', [BlogController::class, 'update'])->name('update');

        Route::get('{id}/list-comments', [BlogController::class, 'list_comments'])->name('list-comments');
        Route::get('{id}/add-comment', [BlogController::class, 'add_comment'])->name('add-comment');
        Route::post('{id}/save-comment', [BlogController::class, 'save_comment'])->name('save-comment');
    });
});
