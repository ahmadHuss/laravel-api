<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        $categories = Category::select('id','name')->get();
        $products = Product::select('name', 'price', 'description')->get();
        return view('home', compact('categories', 'products'));
    }
}
