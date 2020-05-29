<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\ManageProductModel;
use App\Http\Resources\Product as ProductResource;
use Illuminate\Http\Request;
use Storage;
// use DB;


class ManageProductController extends Controller
{

    public function index()
    {
       $products = ManageProductModel::paginate(2);
      //$products = DB::table('products')->selectRaw("*")->get();
        return ProductResource::collection($products);
    }

    public function store(Request $request)
    {
          $data = $this->validateProductRequest($request);

          if ($request->product_image != '') {
              $explodebasefile = explode(',', $request->product_image);
              $decodeImage = base64_decode($explodebasefile[1]);
              if (strpos($explodebasefile[0], 'jpeg') === true) {
                 $extension = 'jpeg';
              }
              else if (strpos($explodebasefile[0], 'jpg') === true) {
                 $extension = 'jpeg';
              }
              else {
                $extension = 'png';
              }
              $filename = 'image'.time().'.'.$extension;
              Storage::disk('local')->put($filename, $decodeImage);

              ManageProductModel::create($request->except('product_image') + [
                   'product_image' => $filename
              ]);
               return response()->json('Product Added Successfully');
        }
        else {
              ManageProductModel::create($this->validateProductRequest($request));
              return response()->json('Product Added Successfully');
        }

    }

    public function show(ManageProductModel $products, $id)
    {
        return response()->json($products->where('product_id', $id)->get());

    }

    public function update(Request $request, ManageProductModel $products, $id)
    {
        $data = $this->validateProductRequest($request);

        if ($request->product_image != '') {
            $explodebasefile = explode(',', $request->product_image);
            $decodeImage = base64_decode($explodebasefile[1]);
            if (strpos($explodebasefile[0], 'jpeg') === true) {
               $extension = 'jpeg';
            }
            else if (strpos($explodebasefile[0], 'jpg') === true) {
               $extension = 'jpeg';
            }
            else {
              $extension = 'png';
            }
            $filename = 'image'.time().'.'.$extension;
            Storage::disk('local')->put($filename, $decodeImage);

            $products::where('product_id', $id)->update($request->except('product_image') + [
                 'product_image' => $filename
            ]);
            return response()->json('Product Updated Successfully');
        } else {
            $products::where('product_id', $id)->update($request->except('product_image'));
            return response()->json('Product Updated Successfully');
        }
    }

    public function destroy(ManageProductModel $products, $id)
    {
        $products::where('product_id', $id)->delete();
        return response()->json('Product Successfully Removed');
    }

    private function validateProductRequest($request)
    {
        return $request->validate([
            'product_name' => 'required|min:3',
            'product_image' => 'sometimes',
            'category' => 'required',
            'product_price' => 'required',
            'stocks_left' => 'required',
            'product_desc' => 'required|min:3',
            'store_of' => 'required|min:3',
        ]);
    }
}
