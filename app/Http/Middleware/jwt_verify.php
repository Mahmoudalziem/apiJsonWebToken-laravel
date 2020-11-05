<?php

namespace App\Http\Middleware;


use Closure;
use Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class jwt_verify
{
    /** 
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$guard)
    {

        try{

            if(!$user = Auth::guard($guard)->check()){

                return response()->json(['Unauthorized']);
            }
        }

        catch(JWTException $e){

            return response()->json(['token_absent']);
        }

        catch(TokenExpiredException $e){

            return response()->json(['token_expired']);
        }

        catch(TokenInvalidException $e){

            return response()->json(['Unauthorized']);
        }

        return $next($request);
    }
}
