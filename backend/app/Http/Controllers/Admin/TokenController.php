<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Login_token;
use Illuminate\Http\Request;

class TokenController extends Controller
{
    public function gettoken(Request $request){
        $user = Login_token::where('token', $request->token)->with('User')->get();
        return response()->json($user, 200);
    }
}
