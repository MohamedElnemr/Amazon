<?php

namespace Module\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\StoreResource;
use Modules\Vendor\Entities\Store;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class StoreController extends Controller
{

    public function index()
    {

        $stores = Store::get();

       return response()->json(StoreResource::collection($stores));
        }


    public function store(Request $request)
    {

       $validator = validator::make($request->all(),[
           'name'=>'required',
           'email'=>'required|email',
           'password'=> 'required',
           'url'=>'nullable',
           'status'=> 'required',
       ]);

       if($validator->fails()){
           return response()->json("validate error");
       }

          $stores = Store::create([
            'name'=>$request->name,
            'email'=> $request->email,
            'password' => $request->password,
            'url'=> $request->url,
            'status'=>$request->status,
        ]);

        return response()->json(new StoreResource($stores));
    }


    public function show($id)
    {
        $stores = Store::find($id);
        return response()->json(new StoreResource($stores));

    }

    public function update(Request $request , $id)
    {
        $stores = Store::find($id);
       $stores->update($request->all());

        return response()->json(new StoreResource($stores));

    }


    public function destroy( $id)
    {
        $stores = Store::find($id);
        $stores->delete();
        return response()->json(new StoreResource($stores));

    }
}



