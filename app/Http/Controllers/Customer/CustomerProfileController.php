<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Repositories\Customer\CustomerRepositoryInterface;
use App\Http\Requests\CustomerFormRequest;

class CustomerProfileController extends Controller
{
    private $customerRespository;

    public function __construct(CustomerRepositoryInterface $customerRespository) {

        $this->customerRespository = $customerRespository;
    }

    public function store(CustomerFormRequest $request)
    {
        $save_customer = $this->customerRespository->store($request);
        return response()->json($save_customer);
      
    }

    public function show($username)
    {
        $get_customer = $this->customerRespository->show($username);
        return response()->json($get_customer);
    }

    public function update(CustomerFormRequest $request, $username)
    {
       
        $update_customer = $this->customerRespository->update($username, $request);
        return response()->json($update_customer);
    }

    public function destroy($id)
    {
        //
    }

   
}
