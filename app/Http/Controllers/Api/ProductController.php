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
        /**
         * In Traditional way we use this approach to generate pagination links.
         * $products = Product::with('category')->paginate(9);
         * After that we use interpolate syntax in blade file to render pagination links. { $products->link }
         * API approach is similar to like this one.
         */
        $products = Product::with('category')->paginate(9);
       // return $products;
        return ProductResource::collection($products);
    }


    public function show(Product $product) {
        return new ProductResource($product);
    }
}
