@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">


             <div class="panel panel-default">
                <div class="panel-heading"><span class="pull-right"><a href="#" class="btn btn-default btn-sm">Edit Order</a></span></div>

                <div class="panel-body">

                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <h2> Edit Order </h2>
                        <hr/>
                        {!! Form::open(['action' => ['OrdersController@update', $order->id], 'method' => 'POST']) !!}
                            <div class="form-group">
                                {{Form::label('user_id', 'User')}}
                            {!! Form::select('user_id', $users_list, $order->user_id, ['class' => 'form-control']) !!}
                              
                            </div>

                             <div class="form-group">
                                {{Form::label('product_id', 'Product')}}
                            {!! Form::select('product_id', $products_list, $order->product_id, ['class' => 'form-control']) !!}
                              
                            </div>


                             <div class="form-group">
                                {{Form::label('quantity', 'Quantity')}}
                                {{Form::text('quantity', $order->quantity, ['class' => 'form-control'])}}
                            </div>

                            {{Form::hidden('_method', 'PUT')}}
                            {{Form::submit('Add', ['class' => 'btn btn-info'])}}
                        
                        
                        {!! Form::close() !!}
                    </div>
                </div>

                </div>
            </div>

         </div>
    </div>
    </div>
@endsection
