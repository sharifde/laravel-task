<?php
   
namespace App\Http\Controllers\API;
use App\Http\Resources\productResource; 
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Product;
use Validator;
// use App\Http\Resources\Product as ProductResource;
class ProductController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Product::latest()->get();
        return response()->json([ProductResource::collection($data), 'Programs fetched.']);
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

        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description
         ]);
        
        return response()->json(['product created successfully.', new ProductResource($product)]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        if (is_null($product)) {
            return response()->json('Data not found', 404); 
        }
        return response()->json([new ProductResource($product)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, product $product)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'description' => 'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }

        $product->name = $request->name;
        $product->description = $request->description;
        $product->save();
        
        return response()->json(['product updated successfully.', new ProductResource($product)]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request ,$id)
    {   

        $product = Product::find($id);
        if (is_null($product)) {
            return response()->json('Data not found', 404); 
        }
        $product->delete();

        return response()->json('product deleted successfully');
    }
}