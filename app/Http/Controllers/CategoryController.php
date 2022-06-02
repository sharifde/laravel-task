<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('category.index')->with('categries' , Category::paginate(4));
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
         if($request->id==null){

           // dd($request->all());
           $book   =new  Category;
           
                $book->name_en= $request->name_en; 
                $book->name_ar= $request->name_ar; 
                $book->des_en= $request->des_en; 
                $book->des_ar= $request->des_ar; 
                $book->status= $request->status;
                $book->save();
                // 'author= $request->author;
                toastr()->success('New Record is been added'); 
             
            // toastr()->success('New Record is been added'); 
                     

           
        }   
        else{

            $book   =Category::find($request->id);
            $book->name_en= $request->name_en; 
            $book->name_ar= $request->name_ar; 
            $book->des_en= $request->des_en; 
            $book->des_ar= $request->des_ar; 
            $book->status= $request->status;
            $book->save();
            toastr()->info('Recrod  is update');
        }   
        return response()->json(['success' => true]);          
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $where = array('id' => $request->id);
        $book  = Category::where($where)->first();
       
         
        return response()->json($book);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $book = Category::where('id',$request->id)->delete();
        toastr()->warning('Record is been deleted');
        return response()->json(['success' => true]);
    }
}
