<?php

namespace App\Http\Controllers\Api\Product;

use App\Http\Controllers\Controller;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ProductController extends Controller
{
    public function addProduct(Request $request){

        // Create a validator instance
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'sku' => 'required|string|max:20',
            'brand_id' => 'required|integer',
            'category_id' => 'required|integer',
            'description' => 'nullable',
            'usp' => 'nullable',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //Create Product
        Products::create($request->all());

        return response()->json(['message' => 'Product created successfully.'], 200);
    }
}
