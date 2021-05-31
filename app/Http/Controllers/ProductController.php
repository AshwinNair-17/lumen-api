<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index()
    {
        $products = Product::all();
        return response()->json($products);
    }

    public function store(Request $request){
        $product = new Product;

        $product->name = $request->name;
        $product->price = $request->price;
        $product->category = $request->category;

        $product->save();
        return response()->json(array(
            'message' => "Product created successfully",
            'product' => $product
            
        ));
    }

    public function delete($id){
        $product = Product::find($id);
        $product->delete();

        return response()->json("Product deleted successfully");
    }

    public function show($id){
        $product = Product::find($id);
        return response()->json($product);

    }

    public function update(Request $request,$id){
        $product = Product::find($id);
        $product->name = $request->name;
        $product->price = $request->price;
        $product->category = $request->category;

        $product->update();

        return response()->json("Product updated successfully");
    }

    public function search(Request $request){
        // $quer = "";
        $quer = $request->quer;
        $product = Product::where('name','LIKE',"%$request->quer%")->get();
        
        return response()->json($product);
    }
    //
}
