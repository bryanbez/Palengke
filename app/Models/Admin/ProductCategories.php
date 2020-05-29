<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class ProductCategories extends Model
{
    protected $guarded = [];
    protected $table = 'product_categories';

    // public function products() {
    //   return $this->hasMany(ManageProductModel::class);
    // }

    public function store($request) {

        $storecategory = new ProductCategories();
        $storecategory->category_name = $request->category;
        $storecategory->category_desc = $request->description;
        $storecategory->save();
        return response()->json('Data stored successfully');
    }

    public function deleteCategory($id) {

        $delete = ProductCategories::where('id', $id)->delete();
        return response()->json('Product Category Deleted');
    }

    public function show($id) {

      $show_categories = ProductCategories::where('id', $id)->get();
      return response()->json($show_categories);

    }


}
