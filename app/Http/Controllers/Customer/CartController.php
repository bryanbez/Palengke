<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Customer\Cart;
use Illuminate\Http\Request;
use App\Http\Resources\CartResource;

class CartController extends Controller
{

    public function index()
    {
        $showAll = Cart::all();
        dd($showAll->products->product_id);
        //return response()->json($showAll);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        try {
            Cart::create($this->validateCartRequest($request));
            return response()->json('Cart Successfully placed');
        }
        catch(Exception $e) {
            return response()->json('Error inserting in database');
        }
    }

    public function show(Cart $cart, $name)
    {
        $showCustomerCart = Cart::where('customer_name', $name)->get();
        return CartResource::collection($showCustomerCart);
    }

    public function showCartCount(Cart $cart, $name) {
        $showCustomerCartCount = Cart::where('customer_name', $name)->count();
        return response()->json(['cart_count' => $showCustomerCartCount]);
    }

    public function showSpecificCartInfo($name, $cartId) {
        $specificCartInfo = Cart::where('customer_name', $name)->where('cart_id', $cartId)->get();
        return CartResource::collection($specificCartInfo);
    }

    public function updateQuantity(Request $request, Cart $cart)
    {
        try {
            $updateQuantity = $cart::where('cart_id', $request->cart_id)->update([
                'quantity' => $request->quantity,
                'total_price' => $request->total_price
            ]);
            return response()->json('Product Quantity Updated');
        }
        catch(Exception $e) {
            return response()->json('Error in updating quantity');
        }

    }

    public function removeItem(Cart $cart, $name, $cart_id)
    {
      //dd($cart_id);
          $remove_product = $cart::where('cart_id', $cart_id)->delete();
          return response()->json('Product Deleted');
    }

    private function validateCartRequest($request) {

        return $request->validate([
            'customer_name' => 'required',
            'price' => 'required',
            'product_id' => 'required',
            'quantity' => 'required',
            'total_price' => 'required'
        ]);
    }
}
