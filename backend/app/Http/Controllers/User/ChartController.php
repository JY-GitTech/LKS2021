<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Chart;
use App\Models\Login_token;
use App\Models\Produk;
use App\Models\User;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChartController extends Controller
{
    public function index(Request $request)
    {
        $token_id = Login_token::where('token', $request->token)->first()->user_id;
        $chart = Chart::where("user_id", $token_id)->with(['Produk', 'User'])->get();
        return response()->json($chart);
    }
    public function store(Request $request, $id)
    {
        $produk_id = Produk::find($id);
        $user = Login_token::where('token', $request->token)->get();
        $data = Chart::create([
            'user_id' => $user->first()->user_id,
            'produk_id' => $produk_id->id,
            'qty' => $request->qty,
            'harga' => $produk_id->harga,
            'total_harga' => $produk_id->harga*$request->qty
        ]);
        return response()->json($data, 200);
    }
    public function delete($id)
    {
        $chart = Chart::find($id)->delete();
        if($chart){
            return response()->json("deleted");
        }
    }
}
