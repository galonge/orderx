<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\User;
use App\Product;
use App\Order;
use DB;

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



       $search_query = \Request::get('search_query'); //<-- we use global request to get the param
       $filter = \Request::get('filter'); 

       //perform search for query term

       if(isset($search_query)) {

            $search_result = Order::search($search_query, ['product_id','products.name', 'user.name'])->get();
            
            if($filter == 'past7days') {
                $orders = $search_result->where('created_at', '>=', Carbon::now()->subWeek())->get();
            } elseif($filter == 'today') {
                $orders = $search_result->where('created_at', DB::raw('CURDATE()'))->get(5);
                // $orders = $search_result->where('created_at', '>=', Carbon::now())->get(5);
            } else {
                 $orders = $search_result;
            }


       } elseif(isset($filter)) {

             if($filter == 'past7days') {
                $orders = $orders->where('created_at', '>=', Carbon::now()->subWeek())->get();
            } elseif($filter == 'today') {
                $orders = $orders->where('created_at', DB::raw('CURDATE()'))->get(5);
                // $orders = $search_result->where('created_at', '>=', Carbon::now())->get(5);
            } else {
                 $orders = $orders;
            }


       }  else {
            $orders = $orders;
       }

        $data = array('orders' => $orders, 'users_list'=>$users_list, 'products_list'=>$products_list);

        return view('home')->with($data);
    }
}








