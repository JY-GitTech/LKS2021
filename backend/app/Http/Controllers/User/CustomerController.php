<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Chart;
use App\Models\Login_token;
use App\Models\News;
use App\Models\Produk;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function produk(){
        $produk = Produk::all();
        return response()->json($produk);
    }
    public function produkid($id){
        $produk = Produk::find($id);
        return response()->json($produk,200);
    }
    public function news(){
        $news = News::all();
        return response()->json($news);
    }
    public function userchart(Request $request){
        $data = Login_token::where('token', $request->token)->first()->user_id;
        $chart = Chart::where("user_id", $data)->get();
        return response()->json($chart);
    }
    public function deletechart(Request $request){
        $user_id = Login_token::where('token', $request->token)->first()->user_id;
        $chart = Chart::where("user_id", $user_id)->delete();
        if($chart){
            return response()->json("deleted");
        }
    }
}
