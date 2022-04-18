<?php

use App\Http\Controllers\Admin\BeritaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BeritaGooritaController;

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

//public berita
Route::get('/', [BeritaGooritaController::class, 'index'])->name('berita.public');
Route::get('/detail/{id}', [BeritaGooritaController::class, 'detail'])->name('berita.detail');


//crud admin berita dengan middleware
Route::resource('dashboard', BeritaController::class, ['name' => 'dashboard'])->middleware(['auth']);

require __DIR__ . '/auth.php';
