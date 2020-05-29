<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer\OrderModel as Order;


class OrderController extends Controller
{
  
    public function index()
    {
        //
    }

   
    public function create()
    {
        //
    }

 
    public function store(Request $request)
    {
        try {
            Order::create($this->passValidateRequest($request));
            return response()->json('Order Created');
        }
        catch(Exception $e) {
            return response()->json('Something wrong in creating order: ', $e);
        }
    }

 
    public function show($id)
    {
        $getCustomerOrder = Order::where('customer_name', $customer_name)->get();
        return response()->json($getCustomerOrder);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    private function passValidateRequest($request) {

        return $request->validate([
            'order_id' => 'required',
            'customer_name' => 'required|min:3',
            'product_id' => 'required',
            'quantity' => 'required',
            'total_price' => 'required',
            'payment_method' => 'required',
            'order_status' => 'required'
        ]);
    }
}
