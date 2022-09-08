<?php

namespace Modules\Vendor\Repositories;

use F9Web\ApiResponseHelpers;
use Illuminate\Support\Facades\DB;
use Modules\Vendor\Entities\Product;
use Modules\Vendor\Resources\ProductResource;


class ProductRepositories
{
    use ApiResponseHelpers;

    public function showAllProduct()
    {
        try {
            $product = Product::all();
            return $this->respondWithSuccess(ProductResource::collection($product));
        } catch (\Throwable $th) {
            return $this->respondError($th->getMessage() . $th->getFile());
        }
    }

    public function createProduct($request)
    {
        DB::beginTransaction();
        try {
            $product = Product::create($request->validated());
            DB::commit();
            return $this->respondCreated(new ProductResource($product));
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->respondError($th->getMessage() . $th->getFile() . $th->getLine());
        }
    }

    public function showOneProduct($id)
    {
        try {
            $product = Product::findOrFail($id);
            return $this->respondCreated(new ProductResource($product));
        } catch (\Throwable $th) {
            return $this->respondError($th->getMessage());
        }
    }

    public function updateProduct($request, $id)
    {
        try {
            $product = Product::findOrFail($id);
            $product->update($request->validated());
            return $this->respondWithSuccess(new ProductResource($product));
        } catch (\Throwable $th) {
            return $this->respondError($th->getMessage());
        }
    }

    public function deleteProduct($id)
    {
        try {
            $product = Product::findOrFail($id);
            $product->delete();
            return $this->respondError('Product Deleted Successfully');
        } catch (\Throwable $th) {
            return $this->respondError($th->getMessage());
        }
    }
}
