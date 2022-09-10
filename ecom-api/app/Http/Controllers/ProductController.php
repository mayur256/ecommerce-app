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
     * @POST /product
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

    /**
     * @PUT /product/productId
     * @param Request $request
     * @return Response
     * @desc Updates a product with details corresponding to request fields
     */
    public function updateProduct(Request $request, $productId = NULL) {
        // Standard Response Vars
        $resCode = 200;
        $error = false;
        $resPayload = [];

        // get all inputs from request
        $inputs = $request->all();

        // Define validation for request inputs
        $validator = Validator::make($inputs, [
            'name' => 'string|max:255',
            'price' => 'numeric',
            'desc' => 'string|max:255',
            'brand' => 'integer',
            'category' => 'integer'
        ]);

        // Proceed only if the request is validated
        if ($validator->passes() && sizeof($inputs) > 0) {
            try {
                // get product by its id
                $product = Product::find($productId);
                // Update the product if it exists
                if ($product !== null) {

                    // check for set keys in request and update the field
                    if (isset($inputs['name']) && !empty($inputs['name'])) {
                        $product->name = $inputs['name'];
                    } else if (isset($inputs['price']) && !empty($inputs['price'])) {
                        $product->name = $inputs['price'];
                    } else if (isset($inputs['desc']) && !empty($inputs['desc'])) {
                        $product->name = $inputs['desc'];
                    } else if (isset($inputs['brand']) && !empty($inputs['brand'])) {
                        $product->name = $inputs['brand'];
                    } else if (isset($inputs['category']) && !empty($inputs['category'])) {
                        $product->name = $inputs['category'];
                    }
                    // save the changes
                    $product->save();
                } else {
                    $resCode = 400;
                    $error = true;
                    $resPayload['error_msg'] = Constant::SOMETHING_WRONG;    
                }

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

            if (sizeof($inputs) === 0) {
                $resPayload['error_msg'] = "No input field was specified";
            }
        }

        return response()->json([
            'error' => $error,
            'payload' => $resPayload,
        ], $resCode);
    }

    /**
     * @DELETE /product/productId
     * @param Request $request
     * @return Response
     * @desc Deletes a product with a given id in the URL
     */
    public function deleteProduct($productId = NULL){
         // Standard Response Vars
        $resCode = 200;
        $error = false;
        $resPayload = [];

        if ($productId) {
            try {
                $product = Product::find($productId);
                $product->delete();
                $resPayload['success_msg'] = "Product" . " " . Constant::DELETE_SUCCESS;
            } catch(Exception $ex) {
                $resCode = 500;
                $error = true;
                $resPayload['error_msg'] = Constant::INTERNAL_SERVER_ERROR;
            }
        } else {
            $resCode = 400;
            $error = true;
            $resPayload['error_msg'] = Constant::SOMETHING_WRONG;
        }

        return response()->json([
            'error' => $error,
            'payload' => $resPayload,
        ], $resCode);
    }
}
