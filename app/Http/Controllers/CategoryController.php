<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\Category;
// use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.category.index')->with('categries' , Category::paginate(4));
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
        
        $validator = Validator::make($request->all(), [
           
            'name_en' => 'required',
            'name_ar' => 'required',
            'des_en' => 'required',
            'des_ar' => 'required',
            
        ]);
        if ($validator->fails()) {
            return response()->json([
            'success' => JsonResponse::HTTP_BAD_REQUEST,
            'message' => $validator->errors()->first()
            ], JsonResponse::HTTP_BAD_REQUEST);
        }
        
        
        // if ($validator->fails())
        // {
        //     return response()->json(['errors'=>$validator->errors()->all()]);
        // }
         if($request->id==null){

           // dd($request->all());
           $category   =new  Category;
           
                $category->name_en= $request->name_en; 
                $category->name_ar= $request->name_ar; 
                $category->des_en= $request->des_en; 
                $category->des_ar= $request->des_ar; 
                $category->status= $request->status;
                $category->save();
                // 'author= $request->author;
                toastr()->success('New Record is been added'); 
             
            // toastr()->success('New Record is been added'); 
                     

           
        }   
        else{

            $category   =Category::find($request->id);
            $category->name_en= $request->name_en; 
            $category->name_ar= $request->name_ar; 
            $category->des_en= $request->des_en; 
            $category->des_ar= $request->des_ar; 
            $category->status= $request->status;
            $category->save();
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
        $category  = Category::where($where)->first();
       
         
        return response()->json($category);
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
        $category = Category::where('id',$request->id)->delete();
        toastr()->warning('Record is been deleted');
        return response()->json(['success' => true]);
    }
}
