<?php
// namespace declaration for controller
namespace App\Http\Controllers;

// Models
use App\Models\User;

// Facades
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

// Carbon Date/Time Package
use Carbon\Carbon;

// Mailable classes
use App\Mail\UserRegistered;

// Utils
// Constants
use App\Utils\Constant;

class UserController extends Controller
{
    /**
     * @POST /register
     * @param Request $request
     * @return Response
     * @description - Registration of a new user
     */
    public function register(Request $request) {
        // Standard Response Vars
        $resCode = 200;
        $error = false;
        $resPayload = [];

        // get all inputs from request
        $inputs = $request->all();

        // Define validation for request inputs
        $validator = Validator::make($inputs, [
            'email' => 'required|string|unique:users|max:255',
            'password' => 'required|string|max:255',
            'user_type' => 'nullable|string',
            'first_name' => 'required|string|max:255',
            'middle_name' => 'string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'required|string|in:male, female',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'pincode' => 'required|string|max:255',
            'billing_address' => 'nullable|string',
            'billing_city' => 'nullable|string',
            'billing_state' => 'nullable|string',
            'billing_pincode' => 'nullable|string'
        ]);

        // Proceed only if the request is validated
        if ($validator->passes()) {
            try {
                $inputs['password'] = Hash::make($inputs['password']);
                $resPayload = User::create($inputs);

                $this->sendRegistrationNotification($resPayload);
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
            'payload' => $resPayload
        ], $resCode);
    }


    /**
     * @POST /login
     * @param Request $request
     * @return Response
     * @description - Handles user login functionality
     */
    public function login(Request $request) {
        // Standard Response Vars
        $resCode = 200;
        $error = false;
        $resPayload = [];

        // get all inputs from request
        $inputs = $request->only(['email', 'password']);

        // Define validation for request inputs
        $validator = Validator::make($inputs, [
            'email' => 'required|string|max:255',
            'password' => 'required|string|max:255',
        ]);

        // Proceed only if the request is validated
        if ($validator->passes()) {
            try {
                
                if ($token = Auth::attempt($inputs)) {
                    $resPayload =[
                        'access_token' => $token,
                        'token_type' => 'bearer',
                        'expires_in' => auth()->factory()->getTTL() * 60
                    ];
                } else {
                    $resCode = 400;
                    $error = true;
                    $resPayload['error_msg'] = Constant::INVALID_CREDS;
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
        }

        return response()->json([
            'error' => $error,
            'payload' => $resPayload,
        ], $resCode);
    }

    /**
     * @param {string} userName
     * @return void
     * @desc - sends a welcome email to the newly registered user
     */
    private function sendRegistrationNotification(User $user) {
        $userName = $user->first_name . "  " . $user->last_name;
        $email = $user->email;
    
        try {
            Mail::to($email)
            ->send(new UserRegistered($userName));
            
            $user->email_verified_at = Carbon::now();
            $user->save();
        } catch (Exception $ex) {
            // handle error
            $user->email_verified_at = null;
            $user->save();
        }
    }
}
