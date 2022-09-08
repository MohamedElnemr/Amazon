<?php

namespace App\Http\Controllers;

use App\Http\Filter\FilterHelper;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function test($id)
    {

        // $test = Product::where('id',$id)->with('category')->first();
        // dd($test) ;

        // $test = Category::where('id',$id)->with('product')->first();
        // dd($test) ;

        // $test = Product::where('id',$id)->with('store')->first();
        // dd($test) ;

        // $test = Store::where('id',$id)->with('product')->first();
        // dd($test) ;

    }


    public function index()
    {
        // $products = Product::get();
        // $productResource = ProductResource::collection($products);
        // return $this->respondWithSuccess($productResource);


        // $date1 = "2021-12-16 18:16:14";
        // $date2 = "2021-12-18 06:28:10";
        // return Product::whereBetween('created_at', [$date1, $date2])->get();

        try {
            return $this->respondWithSuccess(ProductResource::collection(Product::get()));
        } catch (\Throwable $th) {
           return $this->respondError($th->getMessage());
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        DB::beginTransaction();

        try {
            $category = Category::create([
                'test' => $request->category,

            ]);

            $store = Store::create([
                'test' => $request->store,

            ]);

            $product = Product::create([
                'name' => $request->name,
                'price' => $request->price,
                'description' => $request->description ,
                'qty' => $request->qty,
                'category_id' => $category->id,
                'stors_id'=> $store->id,
                ]);

        DB::commit();

            $productResource = new ProductResource($product);
            return $productResource;
        } catch (\Throwable $th) {
            DB::rollback();
            return $this->respondError($th->getMessage());
        }


    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $product = Product::find($request->product_id);
        // $productResource = new ProductResource($product);
        // return $productResource;
        try {
            return $this->respondWithSuccess(new ProductResource(Product::find($id)));
        } catch (\Throwable $th) {
            return $this->respondError($th->getMessage());
        }
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        try {
            $request->validate([
                'name' => 'required',
                'price' => 'required',
                'description' => 'required',
                'qty' => 'required',
                'test' => 'required',
            ]);

            $product = Product::find($id);
            $category = Category::find($request->category_id);
            $store = Store::find($request->store_id);

            if ($product && $category && $store) {

                if ($product->category_id == $category->id && $product->stors_id == $store->id) {
                    $product->update($request->all());
                    $category->update($request->all());
                    $store->update($request->all());

                    $productResource = new ProductResource($product);
                    return $this->respondWithSuccess($productResource);
                }else {
                    return $this->respondError('The Category Or Store  are not subject to that Product');
                }

            }else{
                return $this->respondError('The Product Or Category Or Store Not Found') ;
            }
        } catch (\Throwable $th) {
            return $this->respondError($th->getMessage());
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        try {
            $product = Product::find($id);

            if ($product) {
                Product::destroy($id);
                return $this->respondOk('Product Deleted');
            }else{
                return $this->respondError('Product Not Found');
            }
        } catch (\Throwable $th) {
            return $this->respondError($th->getMessage());

        }


    }

    public function search(Request $request)
    {
        // $product = Product::query();
        // $keyWord = $request->keyword ;
        // if ($keyWord) {
        //     $product = $product->where('name', 'LIKE', '%'.$request->keyword.'%')
        //                        ->orWhere('description', 'LIKE', '%'.$request->keyword.'%')
        //                        ->orWhereHas('category', function ($item) use ($keyWord){
        //                            $item->where('test', 'LIKE', '%'.$keyWord.'%');
        //                        });
        // }
        // $x = $product->get();
        // return $x;



        // if (Redis::get(\Request::getRequestUri())) {
        //     $product = json_decode(Redis::get(\Request::getRequestUri())) ;
        // }else{
        //     $filter_conditions = $request->only('keyword', 'category_ids', 'store_ids');
        //     $query = FilterHelper::apply(Product::query(), $filter_conditions);
        //     $product = $query->get();
        //     Redis::set(\Request::getRequestUri(), $product);
        // }
        // return $this->respondWithSuccess(ProductResource::collection($product));


        try {
            $filter_conditions = $request->only('keyword', 'category_ids', 'store_ids');
            $query = FilterHelper::apply(Product::query(), $filter_conditions);
            $product = $query->get();

            return $this->respondWithSuccess(ProductResource::collection($product));
        } catch (\Throwable $th) {
           return $this->respondError($th->getMessage());
        }



    }

}
