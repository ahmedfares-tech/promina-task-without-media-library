<?php

use App\Http\Controllers\V1\Albums\AlbumController;
use App\Http\Controllers\V1\Pictures\PictureController;
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


Route::group(['middleware' => 'auth'], function () {
    // Route::get('/', function () {
    //     return view('pages.index');
    // });
    // ! Albums
    Route::prefix('/')->group(function () {

        Route::get('/', [AlbumController::class, 'main'])->name('album.main');
        Route::get('album/{album}', [AlbumController::class, 'index'])->name('album.index');
        Route::post('store/{album}', [AlbumController::class, 'store'])->name('newAlbum');
        
        Route::post('update/{album}', [AlbumController::class, 'update'])->name('editAlbum');
        Route::post('delete/{album}', [AlbumController::class, 'destroy'])->name('deleteAlbum');
    });
    // ! Pictures
    Route::prefix('pictures')->group(function () {
        Route::post('upload/{album}', [PictureController::class, 'store'])->name('uploadImage');
        Route::post('delete/{picture}', [PictureController::class, 'destroy'])->name('deleteImage');
    });
});


require __DIR__ . '/auth.php';
