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
        return view('product.index')->with('products', $product);
    }
     
     
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {  

        //  dd($request->all());
        $bookId = $request->id;
        if($bookId){
             
            $book = Product::find($bookId);
            if($request->hasFile('image')){
               
                $file= $request->file('image');

                $filename= 'images/'.date('YmdHi').$file->getClientOriginalName();
                $path = date('YmdHi').$file->getClientOriginalName();
                $file->storeAs('images', $path, 'public');
                $book->image = $filename;


                //$path = $request->file('image')->store('public/images');
                //$book->image = $path;
            }   
         }else{
            $file= $request->file('image');
            $filename= 'images/'.date('YmdHi').$file->getClientOriginalName();
            $path = date('YmdHi').$file->getClientOriginalName();
            $file->storeAs('images', $path, 'public');
            $book = new Product;
            $book->image = $filename;


            //$path = $request->file('image')->store('public/images');
            //$book = new Product;
            //$book->image = $path;
               
         }
         
                $book->name_en = $request->name_en; 
                $book->des_ar = $request->name_ar;
                $book->des_en = $request->des_en;
                $book->des_ar = $request->des_ar;
                $book->price = $request->price;
                $book->category_id = $request->category;
                $book->status = $request->status;
        // $book->author = $request->author;
        $book->save();
        if($request->id==null){
            toastr()->success('New Record is been added'); 
        }
          else{
            toastr()->info('Recrod  is update');
          }
        return Response()->json($book);
        
    }
     
     
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {   
        $where = array('id' => $request->id);
        $book  = Product::where($where)->first();
     
        return Response()->json($book);
    }
     
     
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $book = Product::where('id',$request->id)->delete();
     
        return Response()->json($book);
    }
}
