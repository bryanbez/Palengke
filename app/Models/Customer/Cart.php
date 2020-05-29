<?php

namespace App\Models\Customer;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $guarded = [];
    protected $table = 'customercart';

    public function products() {
      return $this->hasMany(\App\Models\Admin\ManageProductModel::class);
    }
}
