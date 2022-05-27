<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Category;
use App\Http\Resources\CategoryResource;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function search(Request $request){
       dd($request->name);
        $search = Request::get('search');
        $blogs = Category::where('name','like','%'.$search.'%')->orderBy('id')->paginate(6);
        
        return response()->json([CategoryResource::collection($blogs), 'your search result.']);
        
    } 
    public function index()
    {
        $data = Category::latest()->get();
        return response()->json([CategoryResource::collection($data), 'Programs fetched.']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'description' => 'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }

        $program = Category::create([
            'name' => $request->name,
            'description' => $request->desc
         ]);
        
        return response()->json(['Program created successfully.', new CategoryResource($program)]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $program = Category::find($id);
        if (is_null($program)) {
            return response()->json('Data not found', 404); 
        }
        return response()->json([new CategoryResource($program)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Program $program)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'description' => 'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }

        $program->name = $request->name;
        $program->description = $request->description;
        $program->save();
        
        return response()->json(['Program updated successfully.', new CategoryResource($program)]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request ,$id)
    {   

        $program = Category::find($id);
        if (is_null($program)) {
            return response()->json('Data not found', 404); 
        }
        $program->delete();

        return response()->json('Program deleted successfully');
    }
}