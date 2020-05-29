<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class ManageProductModel extends Model
{
    protected $guarded = [];
    protected $table = 'products';

    public function cart() {
      return $this->belongsTo(\App\Models\Customer\Cart::class);
    }


}
