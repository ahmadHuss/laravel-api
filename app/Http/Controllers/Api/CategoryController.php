<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceResponse;

class CategoryController extends Controller
{
    public function index()
    {
        //  return Category::orderBy('id')->get(); // Laravel will return as JSON format.
        // We only want id, name filed in the response.
        // $categories = Category::select('id','name')->get(); This is efficient approach.
        // But we are already defined our toArray response
        $categories = Category::all();
        return CategoryResource::collection($categories); // Now we are returning resource collection
    }

    // Route model binding
    public function show(Category $category)
    {
        // return $category; // It will return category as a JSON response object and it is the magic of Laravel

        // It is difficult to return only id and name with the Route model binding
        // There are only 2 ways:
        // 1.Either you can use collection methods to filter
        // 2.But now  it is time to introduce API resources which will contain set of rules for the API.
        // php artisan make:resource CategoryResource
        return new CategoryResource($category);
    }

    // Post store
    public function store(StoreCategoryRequest $request)
    {
        try {
            $category = Category::create($request->all());
            // 201 means Created Successfully
            return (new CategoryResource($category))->response()->setStatusCode(201);
        } catch (Exception $exception) { // Anything that went wrong
            abort(500, 'Could not create category');
        }
    }


}
