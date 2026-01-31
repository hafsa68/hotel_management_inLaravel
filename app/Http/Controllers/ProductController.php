<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = product::all();
        return view('backend.product.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       $data = Category::all();
        return view('backend.product.create',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
               //$request->cat;
$request->validate([
    'name'=>'required|max:10|min:3',
    'price'=>'required',
    'category'=>'required',
    'sku'=>'required',
    //'photo'=>'mimes:jpg,png,jpeg|max:2408'
    'photo'=>'mimes:jpg,png,jpeg'
],

);
$product_img='';
if($request->photo==null){
 $product_img='product_img/nophoto.jpg';
}else{
   $product_img= request()->photo->move('product_img',$request->photo->getClientOriginalName());
}

         $data = [
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'image' => $product_img,
            'sku'=>$request->sku,
            'category_id' => $request->category,
         ];
         product::create($data);
         //Category::insert($category);
         return redirect()->route('product.index')->with('success','product Added');
    }

    /**
     * Display the specified resource.
     */
    public function show(product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(product $product)
    {


        $imagePath=public_path($product->image);
        unlink($imagePath);
        $product->delete(); 
        return redirect()->route('product.index')->with('success','Successfully deleted');
    }
}
