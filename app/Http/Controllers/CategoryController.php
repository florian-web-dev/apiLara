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
        $category = Category::all();

        // return $category->toJson(JSON_PRETTY_PRINT);

        return response(
            $category->toJson(JSON_PRETTY_PRINT),
            200,
            [
                'content-type' => 'application/json; charset=UTF-8',
                // 'Access-control-allow-methods' => 'GET'

            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Category::create($request->all())) {
            return response()->json([
                'succes' => 'Categorie crée'
            ], 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //    $catID = Category::find($category);
        //    dd($category);
        return $category->toJson(JSON_PRETTY_PRINT);
        // return response()->json([
        //     'data' => $catID,
        //     'name' => $category->name
        // ], 200);

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
        if ($category->update($request->all())) {
            return response()->json([
                'succes' => 'Categorie modifier'
            ], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if ($category->delete()) {
            return response()->json([
                'succes' => 'Categorie supprimé'
            ], 200);
        }
    }
}
