<?php

namespace App\Http\Controllers\Api\DepStock;

use App\Http\Controllers\Controller;
use App\Models\Departments;
use App\Models\StockProducts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DepartmentStockController extends Controller
{
    //

    public function addDepStock(Request $request){
        
         // Create a validator instance
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'challan_no' => 'required|string|max:255',
            'items' => 'required|array',
            'items.*.product_id' => 'required|integer',
            'items.*.qty' => 'required|integer|min:1',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        try {
            // DB::beginTransaction();
            $dept = Departments::where('challan_no', trim($request->challan_no))->first();
            if(!$dept){
                //Create Department
                $dept = Departments::create([
                    'name' => $request->name,
                    'challan_no' => $request->challan_no,
                ]);
            }

            $items = $request->items; 
             //Create Stock Product
            foreach ($items as $item) {
                StockProducts::create([
                    'department_id' => $dept->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['qty'],
                ]);
            }

            return response()->json(['message' => 'Department and Stock created successfully.'], 200);

            DB::commit(); // Commit the transaction if successful
        } catch (\Exception $e) {
            DB::rollback(); // Rollback the transaction on error
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
