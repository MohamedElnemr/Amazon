<?php

namespace Modules\Vendor\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Vendor\Requests\StoreProductRequest;
use Modules\Vendor\Requests\UpdateProductRequest;
use Modules\Vendor\Repositories\ProductRepositories;

class ProductController extends Controller
{
    private $product;
 
    public function __construct(ProductRepositories $productRepositories)
    {
        $this->product = $productRepositories;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return $this->product->showAllProduct($request);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        return $this->product->createProduct($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->product->showOneProduct($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, $id)
    {
        return $this->product->updateProduct($request,$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->product->deleteProduct($id);
    }
}
