<?php

namespace App\Repositories\Customer;
use App\Http\Requests\CustomerFormRequest;

interface CustomerRepositoryInterface 
{
	public function store($customer_data);

	public function show($username);

	public function update($username, $request);

}












