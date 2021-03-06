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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        // return dd($request->all());
        $imageName = time().'.'.$request->image->extension();  
     
        $request->image->move(public_path('productimages'), $imageName);
             $product=new Product;  
                $product->name_en = $request->name_en; 
                $product->des_ar = $request->name_ar;
                $product->des_en = $request->des_en;
                $product->des_ar = $request->des_ar;
                $product->price = $request->price;
                $product->category_id = $request->category;
                $product->status = $request->status;
                $product->image = $imageName;
            // ]);
            $product->save();
            toastr()->success('New Record is been added');
            return response()->json(['success' => true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $where = array('id' => $request->id);
        $book  = Product::where($where)->first();
        // toastr()->info('Recrod  is update');
        toastr()->info('Recrod  is update');
        return response()->json($book);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(request $request)
    {
        $book = Product::where('id',$request->id)->delete();
        toastr()->warning('Record is been deleted');
        return response()->json(['success' => true]);
    }
}
