@extends('layouts.master', ['body_class' => 'shop'])
@section('css')

@endsection
@section('content')
<section id="shop">
	<h2 class="section-title">BOTIGA</h2>
	<div class="center-section">
		<div class="shop-text">
			Compra als nostres concerts!
			<br/>
			En el cas que no puguis venir, posa’t en contacte amb nosaltres!
		</div>
		<div class="shop-container">
			@foreach($products as $product)
			<div class="col-12 col-sm-4 col-md-4 shop-item">
				<a href="{{route('product.show',$product->product_url)}}">
					<div id="product_{{$product->id}}" class="product" product-id="{{$product->id}}">
						<img src="{{ asset('/storage/').'/'.$product->img_url}}" class="img-fluid" alt="{{ $product->name}}"/>
						<div class="product-info">
							<div class="product-name">{{$product->name}}</div>
							<div class="product-price">{{$product->price}} €</div>
						</div>						
					</div>
				</a>
			</div>
			@endforeach
		</div>
	</div>
</section>
@endsection
@section('js')

@endsection