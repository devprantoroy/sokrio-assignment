<?php

namespace App\Http\Controllers\Api\Sales;

use App\Http\Controllers\Controller;
use App\Models\Sales;
use App\Models\SalesItems;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SalesController extends Controller
{
    public function storeGenerate(Request $request){
       
        // Create a validator instance
       $validator = Validator::make($request->all(), [
           'products_id' => 'required|array',
           "products_id.*" => 'required|integer',

           'qty' =>'required|array',
           "qty.*" => 'required|integer|min:1',

           'unit' =>'required|array',
           "unit.*" => 'required|string',

           'sales_price' =>'required|array',
           "sales_price.*" => 'required|integer',

           'payable' =>'required|array',
           "payable.*" => 'required|integer',

           'pay' =>'required|string',
           'due' =>'required|string',
           'remarks' =>'sometimes|nullable',
       ]);
       
       // Check if validation fails
       if ($validator->fails()) {
           return response()->json($validator->errors(), 422);
       }

       try {
        // DB::beginTransaction();
            $items = $request->input('products_id');
            $invoice_id = rand(11111111,99999999);
            $grand_total = array_sum(array_map(function($a, $b) { return floatval($a) * floatval($b); }, $request->qty, $request->sales_price));
            $paid = floatval($request->pay);
            $due = floatval($grand_total) - $paid;
    
             //Create Invoice
            $sales = Sales::create([
            'invoice_id' => $invoice_id,
            'pay' => $paid,
            'due' => $due,
            'grand_total' => floatval($grand_total),
            ]);
    
             //Create Sales Product
            foreach($items as $key => $item){
                SalesItems::create([
                    'sale_id' => $sales->id,
                    'product_id' => $item,
                    'quantity' => $request->qty[$key],
                    'unit' => $request->unit[$key],
                    'sales_price' => $request->sales_price[$key],
                    'payable' => $request->payable[$key],
                ]);
            }

            return response()->json(['message' => 'Sales generated successfully.'], 200);
            DB::commit(); // Commit the transaction if successful
        } catch (\Exception $e) {
            DB::rollback(); // Rollback the transaction on error
            return response()->json(['message' => $e->getMessage()], 500);
        }
   }
}
