<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;

class CategoriesController extends Controller
{
    public function index(){
        $categories = Category::get();

        $response = [
            'success' => true,
            'categories' => $categories,
            'data' => $categories
        ];

        return response($response, 200);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'category'   => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $category = Category::create([
            'Category'     => $request->category,
        ]);

        if($category){
            return response()->json([
                'success' => true,
                'message' => 'Category Inserted Successfully',
                'data'    => $category  
            ], 201);
        }

        return response()->json([
            'success' => false,
            'message' => 'Category Failed to Save',
        ], 409);
    }

    public function show($id){
        $category = Category::findOrFail($id);

        return response()->json([
            'success' => true,
            'message' => 'Detail Data Category',
            'data' => $category,
        ], 200);
    }

    public function destroy($id){
        $category = Category::findOrFail($id);

        if($category) {
            $category->delete();

            return response()->json([
                'success' => true,
                'message' => 'Category Deleted',
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Category Not Found',
        ], 404);
    }
}
