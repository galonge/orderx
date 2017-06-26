@extends('layouts.app')

@section('content')
	<h2> Products </h2>
	@if(count($products) > 0)
		@foreach($products as $product)
			<div class="well">
				<h3><a href="/orderx/products/{{$product->id}}"> {{$product->name}}</a></h3>
					<span class="pull-right" style="font-size:15px;"><strong>{{$product->price}} EUR</strong> </span>
				<p>{!! $product->description !!}</p>
				<small>Added on {{$product->created_at}}</small>
			</div>
		@endforeach

		{{$products->links()}}
	@else
		<p> No products available </p>
	@endif
@endsection