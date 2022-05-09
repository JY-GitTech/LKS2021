<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produk = Produk::all();
        return response()->json($produk, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $produk = $request->all();
        $produk['pathfoto'] = $request->file('pathfoto')->store('img/produk', 'public');
        $store = Produk::create($produk);
        if($store){
            return response()->json($produk, 200);
        }
        return response()->json("Data cannot be processed");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $produk = Produk::find($id);
        return response()->json($produk, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $produk = $request->all();
        $produk['pathfoto'] = $request->file('pathfoto')->store('img/produk', 'public');
        $update = Produk::find($id)->update($produk);
        if($update){
            return response()->json("update success", 200);
        }
        return response()->json('Data cannot be updates');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Produk::where("id", $id)->delete();
        
        if($delete){
            return response()->json("delete success", 200);
        }
        return response()->json("Data cannot be deleted");
    }
}
