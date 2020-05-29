<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Product extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->product_id,
            'product_name' => $this->product_name,
            'product_image' => 'http://localhost:8000/storage/uploads/'.$this->product_image,
            'product_desc' => $this->product_desc,
            'category' => $this->category,
            'product_price' => $this->product_price,
            'store_of' => $this->store_of,
            'stocks_left' => $this->stocks_left
        ];
    }
}
