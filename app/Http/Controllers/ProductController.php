<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

      

    public function index()
    {
        $product=Product::orderBy('id','desc')->paginate(5);
        return view('backend.product.index')->with('products', $product);
    }
     
     
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {  

        
        $productId = $request->id;
        if($productId){
             
            $product = Product::find($productId);
            if($request->hasFile('image')){
               
                $file= $request->file('image');

                $filename= 'images/'.date('YmdHi').$file->getClientOriginalName();
                $path = date('YmdHi').$file->getClientOriginalName();
                $file->storeAs('images', $path, 'public');
                $product->image = $filename;


                //$path = $request->file('image')->store('public/images');
                //$product->image = $path;
            }   
         }else{
            $file= $request->file('image');
            $filename= 'images/'.date('YmdHi').$file->getClientOriginalName();
            $path = date('YmdHi').$file->getClientOriginalName();
            $file->storeAs('images', $path, 'public');
            $product = new Product;
            $product->image = $filename;


            //$path = $request->file('image')->store('public/images');
            //$product = new Product;
            //$product->image = $path;
               
         }
         
                $product->name_en = $request->name_en; 
                $product->name_ar = $request->name_ar; 
                // $product->des_ar = $request->name_ar;
                $product->des_en = $request->des_en;
                $product->des_ar = $request->des_ar;
                $product->price = $request->price;
                $product->category_id = $request->category;
                $product->status = $request->status;
        // $product->author = $request->author;
        $product->save();
        if($request->id==null){
            toastr()->success('New Record is been added'); 
        }
          else{
            toastr()->info('Recrod  is update');
          }
        return Response()->json($product);
        
    }
     
     
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\book  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {   
        $where = array('id' => $request->id);
        $product  = Product::where($where)->first();
     
        return Response()->json($product);
    }
     
     
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\book  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {     
        $product = Product::where('id',$request->id)->delete();
        toastr()->warning('New Record is been deteted'); 
        return Response()->json($product);
    }
}
