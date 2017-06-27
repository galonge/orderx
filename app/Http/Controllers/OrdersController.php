<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Order;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('orders.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('orders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
          $this->validate($request, [
            'product_id' => 'required',
            'user_id' => 'required',
            'quantity' => 'required'
            ]);

        $selected_product = $request->input('product_id');
        $quantity = $request->input('quantity');

        //Get product from Products model
        $product = Product::find($selected_product);

        //calculate total price of order
        if(($product->name == "Pepsi Cola") AND ($quantity >= 3)) {

            $total = $quantity * $product->price;

            //Apply discount of 20%
            $discount = (0.2 * $total);

            $total_price = $total - $discount;

            $order_message = "Order Added. Discount of 20% Applied to order. congratulations!";

        } else {
             $total_price = $quantity * $product->price;

             $order_message = "Order Added successfully";
        }

       



        $order = new Order;
        $order->product_id = $request->input('product_id');
        $order->user_id = $request->input('user_id');
        $order->quantity = $request->input('quantity');
        $order->total = $total_price;
        $order->save();

        $order->products()->attach($order->product_id);

        return redirect('/home')->with('success', $order_message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
