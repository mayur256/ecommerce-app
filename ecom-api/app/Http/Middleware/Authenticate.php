<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use \Illuminate\Http\Request;
use Closure;
use Exception;
use JWTAuth;
use \Tymon\JWTAuth\Exceptions as JWTExceptions;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param Closure $next
     * @param string|null $guard
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $guard = null) {
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (Exception $ex) {
            $errorMsg = "Token is missing";
            $errorCode = 400;

            if ($ex instanceof JWTExceptions\TokenInvalidException) {
                // Token Invalid
                $errorMsg = "Token is Invalid";
                $errorCode = 403;
            } else if($ex instanceof JWTExceptions\TokenExpiredException) {
                // Token has expired
                $errorMsg = "Token is Expired";
                $errorCode = 401;
            } else if($ex instanceof JWTExceptions\TokenBlacklistedException) {
                // Token has expired
                $errorMsg = "Token is Blacklisted";
                $errorCode = 403;
            }

            return response($errorMsg, $errorCode);
        }

        // Proceed to access protected routes
        return $next($request);
    }
}
