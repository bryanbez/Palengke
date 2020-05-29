<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Admin\ManageProductModel as ProductModel;

class CartResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'cart_id' => $this->cart_id,
            'orderDetails' => [
              'customer_name' => $this->customer_name,
              'product_id' => $this->product_id,
              'price' => $this->price,
              'quantity' => $this->quantity,
              'total_price' => $this->total_price
            ],
            'product_info' => [
                'product_name' => ProductModel::where('product_id', $this->product_id)->value('product_name'),
                'product_image' => "http://localhost:8000/storage/uploads/".ProductModel::where('product_id', $this->product_id)->value('product_image'),
            ]

        ];
    }
}
