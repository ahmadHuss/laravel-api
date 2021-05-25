<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceResponse;

class CategoryController extends Controller
{
    public function index(){
       //  return Category::orderBy('id')->get(); // Laravel will return as JSON format.
      // We only want id, name filed in the response.
        return Category::select('id','name')->get();
    }

    // Route model binding
    public function show(Category $category){
        return $category; // It will return category as a JSON response object and it is the magic of Laravel

        // It is difficult to return only id and name with the Route model binding
        // There are only 2 ways:
        // 1.Either you can use collection methods to filter
        // 2.But now  it is time to introduce API resources which will contain set of rules for the API.
        // php artisan make:resource CategoryResource
    }


}
