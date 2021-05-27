<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // We want category object also so that's why we have created the relationship
    // So our query will be use `with()` which help us to return the relationship too.
    public function index() {
        $products = Product::with('category')->get();
       // return $products;
        return ProductResource::collection($products);
    }


    public function show(Product $product) {
        return new ProductResource($product);
    }
}
