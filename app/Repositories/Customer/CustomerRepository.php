<?php

namespace App\Repositories\Customer;

use App\Models\Customer\CustomerProfile;
use App\Http\Requests\CustomerFormRequest;
use App\Repositories\Customer\CustomerRepositoryInterface;


class CustomerRepository implements CustomerRepositoryInterface {

	public function store($customer_data) {

        return CustomerProfile::create($customer_data);
	}

	public function show($username) {

		return CustomerProfile::where('customer_username', $username)->get()
		->map->formatCustomerInfo();
	}

	public function update($username, $request) {

		$customer = CustomerProfile::where('customer_username', $username)->firstOrFail();

		return $customer->update($request);

		
		//return CustomerProfile::where('customer_username', $username)->update($customer_data);
	}



}