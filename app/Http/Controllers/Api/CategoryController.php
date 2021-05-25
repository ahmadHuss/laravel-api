<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceResponse;

class CategoryController extends Controller
{
    public function index(){
         return Category::orderBy('id')->get(); // Laravel will return as JSON format.
    }
}
