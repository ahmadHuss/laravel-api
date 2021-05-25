<?php

use App\Http\Controllers\Api\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// API route all methods are same like ResourceController
// index, |create, store($request)|, show($id), |edit($id), update($request, $id)|, destroy($id)
// Now we have to create the Category API
Route::get('categories', [CategoryController::class, 'index']);

// "{category}" will use Route Model Binding
Route::get('categories/{category}', [CategoryController::class, 'show']);
