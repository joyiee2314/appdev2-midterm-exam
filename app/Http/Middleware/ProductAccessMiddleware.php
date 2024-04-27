<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductAccessMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->apiToken();

        if ($request->isMethod ('get')){
            return $next($request);
        }
        
        if (!$token){
            return response()->json(["error"=>"Token is missing"], 401);
        }
        if (!$token !== env('TOKEN_VALIDATOR')){
            return response()->json(["error"=>"Token is invalid"], 401);
        }
    
            return $next($request);
   
    }
}
