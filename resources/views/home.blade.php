@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><span class="pull-right"><a href="/orders/create" class="btn btn-info btn-sm">Create Order</a></span></div>

                <div class="panel-body">
                    <h3> Your Orders </h3>
                    <hr/>

                 @if(count($orders) > 0)
                        <table class="table table-striped table-responsive">
                            <tr>
                                <th>User</th>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>

                            @foreach($orders as $order)
                                <tr>
                                    <td>User User</td>
                                    <td>Product Name</td>
                                    <td>Product Price</td>
                                    <td>{{$order->quantity}}</td>
                                    <td>{{$order->total}}</td>
                                    <td>{{$order->created_at}}</td>
                                    <td><a href="#">Edit</a>|<a href="#">Delete</a></td>
                                </tr>



                            @endforeach




                        </table>
                    @else 
                        <p>You have not created any orders yet </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
