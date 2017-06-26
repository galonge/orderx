@extends('layouts.app')

@section('content')
	<h2> Add Product </h2>

	{!! Form::open(['action' => 'ProductsController@store', 'method' => 'POST']) !!}
    	<div class="form-group">
    		{{Form::label('name', 'Name')}}
    		{{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Name'])}}
    	</div>

    	<div class="form-group">
    		{{Form::label('description', 'Description')}}
    		{{Form::textarea('description', '', ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Enter product description here'])}}
    	</div>

    	 <div class="form-group">
    		{{Form::label('price', 'Price')}}
    		{{Form::text('price', '', ['class' => 'form-control', 'placeholder' => 'Enter price per item'])}}
    	</div>

    	{{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
	
	
	{!! Form::close() !!}
	
@endsection