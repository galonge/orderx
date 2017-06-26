@extends('layouts.app')

@section('content')
	
	<a href="/orderx/products" class="btn btn-default">Go Back </a>
	<h2> {{$product->name}}</h2>
		<p> {!! $product->description !!} </p>
	<small>{{$product->created_at}}</small>
@endsection