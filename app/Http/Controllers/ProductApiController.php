<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\ProductResource;

class ProductApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        //customize the data in ProductResource | for many data
        return ProductResource::collection(Product::all());  
           
        // return response()->json(Product::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => "nullable|required|min:3|max:50",
            "price" => "nullable|required|numeric|min:1",
            "stock" => "nullable|required|numeric|min:1"
        ]);
        $product = Product::create([
            "name" => $request->name,
            "price" => $request->price,
            "stock" => $request->stock,
            "user_id" => Auth::id()
        ]);
        return response()->json($product);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //customize the data in ProductResource | for a data
        $product = Product::find($id);
        if(is_null($product)){
            return response()->json(['message'=>'Product not found'],404);
        }
        return response()->json(new ProductResource($product));
            
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
        $request->validate([
            "name" => "nullable|min:3|max:50",
            "price" => "nullable|numeric|min:1",
            "stock" => "nullable|numeric|min:1"
        ]);
        $product = Product::find($id);
        if(is_null($product)){
            return response()->json(['message'=>'Product not found'],404);
        }
        if($request->has('name')){
            $product->name = $request->name;
        }
        if($request->has('price')){
            $request->price = $request->price;
        }
        if($request->has('stock')){
            $product->stock = $request->stock;
        }
        $product->update();
        return response()->json($product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        if(is_null($product)){
            return response()->json(['message'=>'Product not found'],404);
        }
        $product->delete();
        return response()->json(['message'=>'Product is deleted'],200);
    }
}
