<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Products::with('categories')->get();

        $response = [
            'success' => true,
            'products' => $products,
            'data' => $products->toArray(),
        ];

        return response($response, 200);
    }

    public function store(Request $request)
    {
        $imageName = time() . '.' . $request->product_image->extension();
        $request->product_image->storeAs('public/images', $imageName);
        $location = url("storage/images/" . $imageName);

        $products = Products::create([
            'Product_image' => $location,
            'Product_Name'  => $request->product_name,
            'Pricesell'     => $request->pricesell,
            'Qty'           => $request->qty,
            'Category_id'   => $request->category_id,
        ]);

        if ($products) {
            return response()->json([
                'success' => true,
                'message' => 'Products Inserted Successfully',
                'data'    => $products
            ], 201);
        }

        return response()->json([
            'success' => false,
            'message' => 'Products Failed to Save',
        ], 409);
    }

    public function show($id)
    {
        $product = Products::findOrFail($id);

        return response()->json([
            'success' => true,
            'message' => 'Detail Data Product',
            'data' => $product,
        ], 200);
    }

    public function update(Request $request, Products $product)
    {
        $prod = Products::findOrFail($product->id);

        if ($prod) {
            $prod->update([
                'Product_Name'  => $request->product_name,
                'Pricesell'     => $request->pricesell,
                'Qty'           => $request->qty,
                'Category_id'   => $request->category_id,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Product Updated',
                'data'    => $prod
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Product Not Found',
        ], 404);
    }

    public function destroy($id)
    {
        $product = Products::findOrFail($id);

        if ($product) {
            $product->delete();

            return response()->json([
                'success' => true,
                'message' => 'Product Deleted',
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Product Not Found',
        ], 404);
    }
}
