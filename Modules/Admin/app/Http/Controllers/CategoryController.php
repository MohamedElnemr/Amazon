<?php

namespace Module\Admin\Http\Controllers;


use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;


use App\Http\Filter\FilterHelper;
use Module\Admin\Http\Requests\CategoryRequest;
use Module\Admin\Http\Resources\CategoryResource;
use Module\Admin\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index(Request $request)
    // {
    //     try {
    //         $category = Category::all();

    //     $filter_conditions = $request->only(['keyword','category_ids']);
    //     return $query = FilterHelper::apply(Category::query(), $filter_conditions);

    //     // return $products = $query->get();
    //     $category = Category::all();
    //     if (!empty($category)) {
    //         return $this->respondWithSuccess(CategoryResource::collection($category));
    //     }
    //     } catch (\Throwable $th) {
    //         return $this->respondError($th->getMessage());
    //     }
    // }

    public function index()
    {
        try {

            return $this->respondCreated(CategoryResource::collection(Category::all()));

        } catch (\Throwable $th) {

            return $this->respondError($th->getMessage());
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {

        try {
            $category = Category::create([
                'name' => $request->name,
                'status' => $request->status,

                ]);

            return $this->respondCreated(new CategoryResource($category));
        } catch (\Throwable $th) {

            return $this->respondError($th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $category = Category::findOrFail($id);
            return $this->respondWithSuccess(new CategoryResource($category));
        } catch (\Throwable $th) {
            return $this->respondError($th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        try {
            $category = Category::findOrFail($id);
            $category->fill($request->all())->save();
            $arar = ["name"=>"islam" ,"age"=>""];
            return $this->respondWithSuccess(new CategoryResource($category));
        } catch (\Throwable $th) {
            return $this->respondError($th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $category = Category::findOrFail($id);
            if (count($category->childrens)) {
                return $this->respondError('Category Has Sub Category');
            }
            else{
                $category->delete();
                return $this->respondError("Category Deleted Successfully");
            }
        } catch (\Throwable $th) {
            return $this->respondError($th->getMessage());
        }
    }
}
