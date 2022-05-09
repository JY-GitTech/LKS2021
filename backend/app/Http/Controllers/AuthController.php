<?php

namespace App\Http\Controllers;

use App\Models\Login_token;
use App\Models\User;
use Illuminate\Auth\Events\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request){
        $data = $request->all();
        $data['password'] = Hash::make($data['password']);
        // if(User::where($data['username'], 'username')){
        //     return response()->json('username already exist', 200);
        // }
        User::create([
            'username'=>$data['username'],
            'password'=>$data['password'],
            'role'=>'user'
        ]);
        return $this->login($request);
    }
    public function login(Request $request){
        $credentials = $request->only(['username', 'password']);
        if(Auth::attempt($credentials)){
            $user_name = Auth::user()->username;
            // dd($user_name);
            $token = md5($user_name);
            Login_token::where("token", $token)->delete();
            $login_token = Login_token::create([
                'user_id'=>Auth::id(),
                'token'=>$token,
            ]);
            if($login_token){
                return response()->json([
                    'token'=> $token,
                    'role'=>Auth::user()->role
                ], 200);
            }
        }
        return response()->json([
            'message'=>"invalid login"
        ], 401);
    }
    public function logout(Request $request){
        // dd(Auth::id());
        Login_token::where('token', $request->token)->delete();
        return response()->json('logout success', 200);
    }
}
