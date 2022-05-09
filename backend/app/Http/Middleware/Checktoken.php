<?php

namespace App\Http\Middleware;

use App\Models\Login_token;
use Closure;
use Illuminate\Auth\Events\Login;
use Illuminate\Http\Request;

class Checktoken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $token = $request->token;
        // dd($token);
        if($token){
            $check = Login_token::where("token", $token);
            if($check){
                
                return $next($request);
            }            
        }
        return response()->json("Unauthorized user", 401);
    }
}
