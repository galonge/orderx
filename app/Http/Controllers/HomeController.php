<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Product;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);

        $orders = $user->orders->sortByDesc('created_at');
        $users_list = User::pluck('name', 'id');
        $products_list = Product::pluck('name', 'id');

        //get product for each order

        $data = array('orders' => $orders, 'users_list'=>$users_list, 'products_list'=>$products_list);

        return view('home')->with($data);
    }
}








