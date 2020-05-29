<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\ManageProductModel;
use App\Http\Resources\Product as ProductResource;
use App\Models\Admin\ProductCategories;
use App\Http\Resources\ProductsCountPerCategory as ProductCount;
use DB;

class ProductsController extends Controller
{
    public function index() {

        $products = ManageProductModel::all();
        return ProductResource::collection($products);
    }

    public function countProductsInCategory() {

        $getCategories = ProductCategories::all();
        $countCategory = [];
        foreach ($getCategories as $category) {
            $productCountPerCategory = ManageProductModel::where('category', $category->category_name)->count();
            array_push($countCategory, ['category_name' => $category->category_name, 'count' => $productCountPerCategory]);
        }

        return ProductCount::collection($countCategory);
    }

    public function sortByCategory($category) {

        $byCategory = ManageProductModel::where('category', $category)->get();
        return ProductResource::collection($byCategory);
    }

    public function searchProduct($searchParams) {

        $result = DB::table('products')->select('*')->where('product_name', 'LIKE', '%'.$searchParams.'%')->get();
        return ProductResource::collection($result);
    }

    public function show($id) {

        $singleProduct = ManageProductModel::where('product_id', $id)->get();
        return ProductResource::collection($singleProduct);
    }
}
