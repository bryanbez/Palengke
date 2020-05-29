<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\ProductCategories;

class ManageProductCategories extends Controller
{

    public function index()
    {
        $show_all_categories = ProductCategories::all();
        return response()->json($show_all_categories);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'category' => 'required|min:3',
            'description' => 'required|min:3'
        ]);

        try {
            $insertData = new ProductCategories();
            return $insertData->store($request);
        }
        catch(Exception $e) {
            return response()->json('Error inserting in database');
        }

    }

    public function show($id)
    {
        $showData = new ProductCategories();
        return $showData->show($id);
    }

    public function update(Request $request, $id)
    {

        $validate = $request->validate([
            'category' => 'required|min:3',
            'description' => 'required|min:3'
        ]);

        try {
            $update_category = ProductCategories::where('id', $id)->update([
              'category_name' => $request->category,
              'category_desc' => $request->description
            ]);

            return response()->json('Product Category Sucessfully Updated');
        }
        catch(Exception $e) {
              return response()->json('Error on updating product category');
        }

    }

    public function destroy($id)
    {
        $deleteData = new ProductCategories();
        return $deleteData->deleteCategory($id);
    }
}
