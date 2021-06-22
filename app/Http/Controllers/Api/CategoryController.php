<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Traits\URLScheme;
use App\Models\Category;
use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\Response;

// Updated
class CategoryController extends Controller
{
    use URLScheme;

    public function index()
    {
        //  return Category::orderBy('id')->get(); // Laravel will return as JSON format.
        // We only want id, name filed in the response.
        // $categories = Category::select('id','name')->get(); This is efficient approach.
        // But we are already defined our toArray response
        $categories = Category::orderBy('id')->get();
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
            $data = $this->storeUpdateCategoryPhoto($request);
            $category = Category::create($data);
            return (new CategoryResource($category))->response()->setStatusCode(201);
        } catch (Exception $exception) { // Anything that went wrong
            abort(500, 'Could not create category');
        }
    }


    // Update method
    public function update(Category $category, StoreCategoryRequest $request) {
        try {
            $category->update($request->all());
            return new CategoryResource($category);
        } catch (Exception $e) {
            abort(500,'Could not update category');
        }
    }

    // Delete method
    public function destroy(Category $category) {
        try {
            $category->delete();
            return response(null, RESPONSE::HTTP_NO_CONTENT);
        } catch (Exception $e) {
            abort(500,'Could not delete this category');
        }
    }


    // Method for storing or uploading category name & photo
    private function storeUpdateCategoryPhoto(StoreCategoryRequest $request, Category $category = null, bool $deleteOldFile = false): array
    {
        // Update data
        $data = $request->all();

        if ($request->hasFile('photo')) {

            // If there is a photo(jpg|jpeg|png) inside the request
            // then it means we have to delete the old photo from the file system
            // and replace with the new one.
            if ($deleteOldFile && $category->photo) {
                // Returns trailing name component of path
                $oldPath = basename($category->photo); // 6546dgfgfdgfg.jpg
                Storage::delete('/public/categories/'.$oldPath);
            }

            $file = $request->file('photo');
            /*
            // Old way to store images
            $filename = 'categories/' . uniqid() . '.' . $file->extension(); // categories/6546dgfgfdgfg.jpg
            $file->storePubliclyAs('public', $filename); // Store inside filesystem categories/6546dgfgfdgfg.jpg
            */

            // New way
            $fileDirectory = '/categories/';
            $fileName = uniqid().'.'. $file->extension();
            Storage::putFileAs('public'.$fileDirectory, $file, $fileName);

            $data['photo'] = URL::to(''.'storage'.$fileDirectory.$fileName, [], $this->isSecureScheme()); // http://lara8api.test/storage/categories/6546dgfgfdgfg.jpg
        }
        return $data;
    }
}
