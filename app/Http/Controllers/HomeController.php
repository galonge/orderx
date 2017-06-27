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

       if(isset($search_query)) {

        // $search_results = array();
                // $orders = Order::where('id','like','%'.$search_query.'%')
        // $user_result = User::where('name', 'like', '%'.$search_query.'%')
        // ->orderBy('created_at')
        // ->get();

        // $orders = $user_result->sortByDesc('created_at');


        // $orders = Order::whereHas('user', function($search_query) use($term) {
        //     $query->where('name', 'like', '%'.$term.'%');
        // })->orWhere('product_id','LIKE','%'.$term.'%')->orderBy($order, 'desc')->get();


         
        // $orders = Order::search($search_query, [
        //     'profile.last_name' => 20,
        //     'email' => 10,
        //     'username' => 10,
        //     'profile.first_name' => 5,
        //     'friends.username' => 2,
        //     'friends.email' => 2,
        //     'friends.profile.first_name' => 1,
        //     'friends.profile.last_name' => 1,
        //   ])->get();

            $search_result = Order::search($search_query, ['product_id','products.name', 'user.name'])->get();
            
            if($filter == 'past7days') {
                $orders = $search_result->where('created_at', '>=', Carbon::now()->subWeek())->get();
            } elseif($filter == 'today') {
                $orders = $search_result->where('created_at', DB::raw('CURDATE()'))->get(5);
                // $orders = $search_result->where('created_at', '>=', Carbon::now())->get(5);
            } else {
                 $orders = $search_result;
            }


       }
        
        //get product for each order

        $data = array('orders' => $orders, 'users_list'=>$users_list, 'products_list'=>$products_list);

        return view('home')->with($data);
    }
}








