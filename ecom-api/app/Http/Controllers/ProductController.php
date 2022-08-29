<?php

namespace App\Http\Controllers;

// Models
use App\Models\Product;

// Facades
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\Mail;

// Utils
// Constants
use \App\Utils\Constant;

class ProductController extends Controller
{
    /**
     * @POST product/store
     * @param Request $request
     * @return Response
     * @desc Stores a product with details corresponding to request fields
     */
    public function storeProduct(Request $request) {
        // Standard Response Vars
        $resCode = 200;
        $error = false;
        $resPayload = [];

        // get all inputs from request
        $inputs = $request->all();

        // Define validation for request inputs
        $validator = Validator::make($inputs, [
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'desc' => 'required|string|max:255',
            'brand' => 'required|integer',
            'category' => 'required|integer'
        ]);

        // Proceed only if the request is validated
        if ($validator->passes()) {
            try {
                // store in the database
                $resPayload = Product::create($inputs);
            } catch(Exception $ex) {
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
