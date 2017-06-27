<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Order;
use App\User;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);

        $orders = $user->orders->sortByDesc('created_at');
     

        $data = array('orders' => $orders);

        return view('orders.index')->with($data);
    }

    public function search(Request $request) {
        //search for term

        $this->validate($request, [
            'filter' => 'required',
            'search_query' => 'required'
            ]);

     $query = strtolower($request->input('search_query'));

    



     return view('/home')->with($matchingOrders);
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

        
        $order = Order::find($id);

        $user_id = auth()->user()->id;
        $users_list = User::pluck('name', 'id');
        $products_list = Product::pluck('name', 'id');

        //get product for each order

        $data = array('order' => $order, 'users_list'=>$users_list, 'products_list'=>$products_list);
          return view('orders.edit')->with($data);
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

            $order_message = "Order Updated. Discount of 20% Applied to order. congratulations!";

        } else {
             $total_price = $quantity * $product->price;

             $order_message = "Order Updated successfully";
        }

       

     
        $order = Order::find($id);

        $order->products()->detach();

        $order->product_id = $request->input('product_id');
        $order->user_id = $request->input('user_id');
        $order->quantity = $request->input('quantity');
        $order->total = $total_price;
        $order->save();

        $order->products()->attach($order->product_id);

        return redirect('/home')->with('success', $order_message);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::find($id);
        $order->delete();
        $order->products()->detach($order->product_id);

        return redirect('/home')->with('success', "Order Destroyed");

    }
}
