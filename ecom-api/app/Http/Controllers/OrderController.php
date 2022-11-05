<?php

namespace App\Http\Controllers;

// Models
use App\Models\Order;
use App\Models\Product;

// Facades
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

// Utils
// Constants
use \App\Utils\Constant;

class OrderController extends Controller
{
    /**
     * @POST /order
     * @param Request $request
     * @return Response
     * @desc Creates an order with details provided by client
     */
    public function createOrder(Request $request) {
        // Standard Response Vars
        $resCode = 200;
        $error = false;
        $resPayload = [];

        // get all inputs from request
        $inputs = $request->all();
        $validOrderStatuses = implode(Constant::ORDER_STATUS, ',');
        $validPaymentMethods = implode(Constant::PAYMENT_METHODS, ',');
        $validPaymentStatus = implode(Constant::PAYMENT_STATUS, ',');

        // Define validation for request inputs
        $validator = Validator::make($inputs, [
            'products.*.id' => 'required|numeric',
            'products.*.quantity' => 'required|numeric',
            'order_status' => 'required|string|max:100|in:' . $validOrderStatuses,
            'payment_method' => 'required|string|max:100|in:' . $validPaymentMethods,
            'summary' => 'string|max:255'
        ]);
        
        // Proceed only if the request is validated
        if ($validator->passes()) {
            $products = Product::whereIn('id', array_map(fn($val) => $val['id'], $inputs['products']))->get();
            
            DB::beginTransaction();
            try {
                // product count in request matches valid / active product count
                if ($products->isNotEmpty() && count($inputs['products']) === count($products->toArray())) {

                    // create the order and then add products to the order
                    $order = Order::create([
                        'summary' => $inputs['summary'],
                        'payment_method' => $inputs['payment_method'],
                        'customer_id' => Auth::id()
                    ]);

                    /*foreach($products as $product) {

                    }*/
                    
                    
                    DB::commit();
                } else {
                    DB::rollBack();
                }
            } catch(Exception $ex) {
                DB::rollBack();
                $resCode = 500;
                $error = true;
                $resPayload['error_msg'] = Constant::INTERNAL_SERVER_ERROR;
            }
            
        } else {
            // return a response with validation errors to client
            $resCode = 400;
            $error = true;
            // attach validation error messages to response payload
            if (sizeof($validator->errors()->getMessages()) > 0) {
                $resPayload['error_msg'] = $validator->errors()->getMessages();
            }
        }

        return response()->json([
            'error' => $error,
            'payload' => $resPayload,
        ], $resCode);
    }

}
