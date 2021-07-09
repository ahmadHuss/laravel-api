<?php

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

// ------------- Default SPA Routes -------------
Route::view('/', 'home'); // Just load the Blade File

// Categories create.blade.php file for the form creation.
Route::view('/categories', 'index')->name('categories.index');
Route::view('/categories/create', 'create')->name('categories.create');
Route::view('/categories/{category}/edit', 'edit')->name('categories.edit');
// ------------- End - Default SPA Routes -------------


// ------------- Laravel Breeze Authentication Routes -------------
/*
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');
*/
require __DIR__.'/auth.php';
// ------------- End - Laravel Breeze Authentication Routes -------------
