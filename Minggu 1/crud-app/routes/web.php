<?php //file php

use App\Http\Controllers\ItemController; //menggunakan ItemController agar bisa dipakai dalam route
use App\Http\Controllers\PageController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutControler;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\PhotoController;
use Illuminate\Support\Facades\Route; //memuat class Route untuk mendefinisikan rute aplikasi

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

Route::get('/', function () { //mendaftarkan route GET / (halaman utama)
    return view('welcome'); //menampilkan tampilan welcome.blade.php
});

Route::get('/hello', [WelcomeController::class,'hello']);

Route::get('/world', function () {
    return 'World';
});

Route::get('/', [PageController::class, 'index']);

Route::get('/about', [PageController::class, 'about']);

Route::get('/user/{name}', function ($name) {
    return 'Nama saya ' .$name;
});

Route::get('/posts/{post}/comments/{comment}', function ($postId, $commentId) {
    return 'Pos ke-'.$postId." Komentar ke-: ".$commentId;
});

Route::get('/articles/{id}', [PageController::class, 'articles']);

Route::get('/user/{name?}', function ($name = 'John') {
    return 'Nama saya ' .$name;
});
Route::get('/', HomeController::class);

Route::get('/about', AboutControler::class);

Route::get('/articles/{id}', ArticleController::class);

Route::resource('photos', PhotoController::class);

Route::resource('photos', PhotoController::class)
->only([ 'index', 'show']);

Route::resource('photos', PhotoController::class)
->except(['create', 'store', 'update', 'destroy'
]);
   
Route::get('/greeting', [WelcomeController::class, 'greeting']);

Route::resource('items', ItemController::class); //mendaftarkan semua route CRUD (index, create, store, show, edit, update, destroy) untuk ItemController, menghubungkan endpoint /items dengan metode yang ada di ItemController