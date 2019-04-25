@extends('layouts.master', ['body_class' => 'product'])
@section('css')

@endsection
@section('content')
<section id="product">
	<div class="center-section">
		<div class="product-container">			
			<div class="row">
				<div class="col-md-6">
					<div class="product-img">
						<img src="{{ asset('/storage/').'/' . $product->img_url }}" alt="product" class="img-fluid">
					</div>
				</div>
				<div class="col-md-6">
					<div class="product-data">
						<h1 class="product-name">{{ $product->name }}</h1>
						<h2 class="product-price">{{ $product->price }}€</h2>
						@if($product->description!=null)
						<div class="product-desc">{!! $product->description !!}</div>
						@endif
						<form action="{{ url('cistella') }}" method="POST" class="side-by-side">
							{!! csrf_field() !!}
							@if($product->hasExtras())
							@foreach($product->extras->groupby('type') as $key => $value)
							<div class="product-extra">
								<div class="product-extra-title">{{$key}}</div>
								<div class="product-extra-options">
									@foreach($product->extras->where('type',$key) as $extra)									
									<div class="pExtra-option">					
										<label class="labl">
											@if ($loop->first)
											<input type="radio" name="{{$extra->type}}" value="{{$extra->value}}" checked />
											@else
											<input type="radio" name="{{$extra->type}}" value="{{$extra->value}}" />
											@endif
											<div class="pExtra-text">{{$extra->value}}</div>
										</label>	
									</div>		
									@endforeach
								</div>
							</div>
							@endforeach
							@endif						
							<div class="form-group product-cont-qty">							
								<label for="qty" class="product-qty">Quantitat</label>
								<input type="number" class="form-input" id="qty" name="qty" min="1" value="1" required="">
							</div>
							<input type="hidden" name="id" value="{{ $product->id }}">
							<input type="hidden" name="name" value="{{ $product->name }}">
							<input type="hidden" name="price" value="{{ $product->price }}">
							<input type="submit" class="btn btn-aldarull input-submit" value="AFEGIR A LA CISTELLA">
						</form>
					</div>
				</div> <!-- end col-md-8 -->
			</div> <!-- end row -->
		</div>
	</div>
</section>
@endsection