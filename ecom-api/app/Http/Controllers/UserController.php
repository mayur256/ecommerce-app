<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Models
use App\Models\User;

class UserController extends Controller
{
    //
    /**
     * @POST /register
     * @params Request $request
     * @returns Response
     */
    public function register(Request $request) {
        // Standard Response Vars
        $resCode = 200;
        $error = false;
        $resPayload = [];

        try {
            $inputs = $request->all();
            $resPayload = User::create($inputs);
        } catch(Exception $ex) {
            $resCode = 500;
            $error = true;
            $resPayload['error_msg'] = "Internal Server Error";
        }

        return response()->json([
            'error' => $error,
            'payload' => $resPayload
        ], $resCode);
    }
}
