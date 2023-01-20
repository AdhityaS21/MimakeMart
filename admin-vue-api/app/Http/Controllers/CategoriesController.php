<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;

class CategoriesController extends Controller
{
    public function index(){
        $categories = Category::latest()->get();;

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
}
