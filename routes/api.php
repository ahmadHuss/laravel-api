<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
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
// categories POST Request
Route::post('categories', [CategoryController::class, 'store']);
// categories update method
Route::put('/categories/{category}', [CategoryController::class, 'update']);


// Product API
Route::get('products', [ProductController::class, 'index']);
// "{product}" will use Route Model Binding
Route::get('products/{product}', [ProductController::class, 'show']);


/**
 * Handling API Exceptions
 *
 * Tip 1. Switch APP_DEBUG=false Even Locally
 *
 * If someone calls API route that doesn’t exist, By default, you get this response from API:
 * { "message": ""}
 *
 * Tip 2. Unhandled Routes – Fallback Method
 * Route::fallback() method at the end of routes/api.php, handling all the routes that weren’t matched.
 *
 * The result will be the same 404 response, but now with error message that give some more information
 * about what to do with this error.
 */
Route::fallback(function () {
    return response()->json(['message' => 'Page Not Found. If error persists, contact API Owner.'], 404);
});

/**
 * Tip 3. Override 404 ModelNotFoundException
 *
 * Most often exceptions is that some model object is not found, usually thrown by Model::findOrFail($id).
 * If we leave it at that, here’s the typical message your API will show:
 * {
 * "message": "No query results for model [App\\Models\\Category] 19"
 * }
 *
 * We can do that in app/Exceptions/Handler.php (remember that file, we will come back to it multiple times later),
 * in render() method:
 */

/**
 * Tip 4. Catch As Much As Possible in Validation
 * that consumer posts invalid data, and then stuff breaks.
 * If we don’t put extra effort in catching bad data, then API
 * will pass the back-end validation and throw just simple “Server error”
 * without any details (which actually would mean DB query error).
 *
 * Let’s look at this example – we have a store() method in Controller and StoreFormRequest.
 *
 *
 * Tip 5. Generally Avoid Empty 500 Server Error with Try-Catch
 */

