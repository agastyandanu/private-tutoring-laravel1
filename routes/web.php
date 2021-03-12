<?php

use App\Http\Controllers\AdminController;
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
    return view('home');
});

// admin
Route::get('/admin', [AdminController::class, 'index'])->name('admin');
Route::post('/adminadd', [AdminController::class, 'adminadd'])->name('adminadd');
Route::post('/adminupdate', [AdminController::class, 'adminupdate'])->name('adminupdate');
Route::get('/admindelete/{id}', [AdminController::class, 'admindelete'])->name('admindelete');