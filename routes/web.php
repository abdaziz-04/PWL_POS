<?php

use App\Http\Controllers\LevelController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\POSController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/level', [LevelController::class, 'index']);
Route::get('/kategori', [KategoriController::class, 'index']);
Route::get('/user', [UserController::class, 'index']);
Route::get('/user/tambah', [UserController::class, 'tambah']);
Route::post('/user/tambah_simpan', [UserController::class, 'tambah_simpan']);
Route::get('/user/ubah/{id}', [UserController::class, 'ubah']);
Route::put('/user/ubah_simpan/{id}', [UserController::class, 'ubah_simpan']);
Route::get('/user/hapus/{id}', [UserController::class, 'hapus']);


Route::get('/kategori/create', [KategoriController::class, 'create']);
Route::post('/kategori', [KategoriController::class, 'store']);
Route::get('/kategori/edit/{id}', [KategoriController::class, 'edit']);
Route::put('/kategori/{id}', [KategoriController::class, 'update']);
Route::get('/kategori/delete/{id}', [KategoriController::class, 'delete']);

Route::get('/welcome2', function () {
    return view('welcome2');
});

Route::get('/formUser', [UserController::class, 'formUser']);
Route::get('/formLevel', [UserController::class, 'formLevel']);

// CRUD dengan template
Route::resource('m_user', POSController::class);

// JS 7
Route::get('/barang', [ProductController::class, 'index']);

// ! CRUD USER
Route::group(['prefix' => 'user'], function () {
    Route::get('/', [UserController::class, 'index']); // Tampil Halaman Awal User
    Route::post('/list', [UserController::class, 'list']); // Tampil data user (json)
    Route::get('/create', [UserController::class, 'create']); // Tampil form tambah user
    Route::post('/', [UserController::class, 'store']); // Simpan data user baru
    Route::get('/{id}', [UserController::class, 'show']); // Tampil detail user
    Route::get('/{id}/edit', [UserController::class, 'edit']); // Edit data user
    Route::put('/{id}', [UserController::class, 'update']); // Simpan perubahan data user
    Route::delete('/{id}', [UserController::class, 'destroy']); // Hapus data user
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
