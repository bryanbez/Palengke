<?php

namespace App\Models\Customer;

use Illuminate\Database\Eloquent\Model;

class CustomerProfile extends Model
{
    protected $guarded = [];
    protected $table = 'tblcustomerprofile';

    public function formatCustomerInfo() {
    	return [
    		'customer_username' => $this->customer_username,
    		'customer_first_name' => $this->customer_first_name,
    		'customer_last_name' => $this->customer_last_name,
    		'customer_middle_name' => $this->customer_middle_name,
    		'customer_address' => $this->customer_address,
    		'customer_cp_number' => $this->customer_cp_number,
    		'customer_birthdate' => $this->customer_birthdate,
    		'last_updated' => $this->updated_at->diffForHumans(),
    	];
    }
    
}
