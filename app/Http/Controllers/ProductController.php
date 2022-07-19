<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Product;
use Illuminate\Http\Client\ResponseSequence;

class ProductController extends Controller
{
    public function store(Request $request) {
        $validator = Validator::make($request->all(),[
            'product_name'=>'required|max:255',
            'product_type'=>'required|in:snack','drink','fruit','drug','make-up','cigratte',
            'product_price'=>'required|numeric',
            'expired_at'=>'required|date', 
        ]};
        
        if($validator->fails()) {
            return response()->json($validator->messages())->setStatusCode(404);
        }
        $payload = $validator->validated();
        Product::create([
            'product_name'=>$payload['nama'],
            'product_type'=>$payload['type'],
            'product_price'=>$payload['stok'],
            'expired_at'=>$payload['harga']
        ]);
        return response()->json('Data Produk Berhasil Di Tambahkan')->setStatusCode(201);{
    }
    public function show(){
        $products = Product::all();
        return response()->json($products)->setStatusCode(200);
    }
    function showALL(){
        $products = Product::all();
        return response()->json([
            'msg' => 'data produk keseluruhan',
            'data' => $products
        ],2000);


    }
    function showById($id){
        $product = Product::where('id',$id)->fist();
        
        if($product) {
            return response()->json([
                'msg'=> 'Data produk dengan ID: '.$id,
                'data' => $product
            ],200);
        }

        return response()->json([
            'msg' => 'Data product dengan ID: '.$id. 'tidak di temukan',
        ],484);

    }
    public function showByName($product_name){
        $product = Product::where('product_name','LIKE','%'.$product_name.'%')->get();
        if($product->count() > 0){
            return response()->json([
                'msg' => 'data product  dengan nama yang mirip: '.$product_name,
                'data' => $product
            ],200)
        }

        return response()->json([
            'msg' => 'Data produk dengan nama yang mirip: '.$product_name.'tidak ditemuakan',
        ],484)

    }
    public function update(Request $request,$id) {
        $validator = Validator::make($request->all(),[
            'product_name'=>'required|max:50',
            'product_type'=>'required|in:snack','drink','fruit','drug','make-up','cigratte',
            'product_price'=>'required|numeric',
            'expired_at'=>'required|date', 
        ]);
        if($validator->fails()) {
            return response()->json($validator->messages())->setStatusCode(422);
        }
        $payload = $validator->validated();
        Product::create([
            'product_name'=>$payload['product_name'],
            'product_type'=>$payload['product_type'],
            'product_price'=>$payload['product_price'],
            'expired_at'=>$payload['expired_at']
        ]);
        return response()->json([
            'msg' =>'Data product berhasil di ubah'
        ],201);
    }
    Route::delete('/product/{id}',[ProductController::class,'delete']);
}

