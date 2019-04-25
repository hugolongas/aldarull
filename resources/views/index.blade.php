@extends('layouts.master', ['body_class' => 'main']) 
@section('css')
<link href="{{ asset('/css/venobox.css') }}" rel="stylesheet"> 
@stop 
@section('js')
<script src="{{ asset('/js/venobox.js') }}"></script>
<script src="{{ asset('/js/home.js') }}"></script>

@stop 
@section('content')
<div id="home" class="home">
	<div id="coverWidgets" class="carousel slide" data-ride="carousel">
		<div class="carousel-inner">
			@if(count($covers)>0) @foreach($covers as $cover)
			<div class="carousel-item @if($loop->first) active @endif">
	@include('widgets.'.$cover->GetWidget()->widget_type,array('cover',$cover))
			</div>
			@endforeach @else
			<div class="carousel-item active">
				<div class="cover-widget empty">
					<div class="logo-header"></div>
				</div>
			</div>
			@endif
		</div>
	</div>
</div>
<section id="quisom" class="weare">
	<h1 class="weare-title">ALDARULL</h1>
	<div class="center-section">
		<div class="weare-container">
			<div class="weare-media">
				<div id="imgGrup" class="carousel slide" data-ride="carousel">
					<ol class="carousel-indicators">
						@foreach($slider as $s)
						<li data-target="#imgGrup" data-slide-to="{{$s->id}}" @if ($loop->first)class="active"@endif></li>
						@endforeach
					</ol>
					<div class="carousel-inner">
						@foreach($slider as $s)
						<div class="carousel-item weare-cont @if($loop->first) active @endif">
							<img class="d-block h-100 weare-img" src="{{ asset('/storage/').$s->url}}" alt="First slide">
						</div>
						@endforeach
					</div>
					<a class="carousel-control-prev" href="#imgGrup" role="button" data-slide="prev">
						<i class="far fa-caret-square-left"></i>
						<span class="sr-only">Previous</span>
					</a>
					<a class="carousel-control-next" href="#imgGrup" role="button" data-slide="next">
						<i class="far fa-caret-square-right"></i>
						<span class="sr-only">Next</span>
					</a>
				</div>
			</div>
			<div class="weare-info">
				<div class="weare-text">
					{!!Resources::GetResource('portada.coneixens.text')!!}
				</div>
				<a href="{{route('weare')}}" class="btn btn-aldarull" role="button">Coneixe'ns!</a>
			</div>
		</div>
	</div>
</section>
<section id="schedule" class="schedule">
	<h2 class="schedule-title">AGENDA</h2>
	<div class="center-section">
		<div class="schedule-container">
			<div id="scheduleGroup" class="carousel slide" data-ride="carousel">
				<div class="carousel-inner">
					@foreach($schedules as $schedule)
					<div class="carousel-item @if ($loop->first) active @endif>">
						<div class="schedule-date-day">
							<?php							
							$date = Carbon::createFromTimeStamp(strtotime($schedule->event_date));
							$day = $date->formatLocalized('%d');
							echo $day;
							?>
						</div>
						<div class="schedule-date-month">
							<?php
							$mesos = array("Gener","Febrer","Març","Abril","Maig","Juny","Juliol","Agost","Setembre","Octubre","Novembre","Decembre");
							$date = Carbon::createFromTimeStamp(strtotime($schedule->event_date));
							$month = $date->month;
							$year = $date->year;
							echo $mesos[$month-1].' '.$year;
							?>
						</div>
						<div class="schedule-date-event">
							{{$schedule->event}}
						</div>
						<div class="schedule-date-place">
							{{$schedule->location}}
						</div>
						<div class="schedule-date-time">
							<?php 
							$date = Carbon::createFromTimeStamp(strtotime($schedule->event_time));
							$h = $date->hour;
							$m = $date->minute;
							echo $h.':'.$m;
							?>
						</div>
					</div>
					@endforeach
				</div>
				@if(count($schedules)>1)
				<div class="arrow-container">
					<a class="schedule-prev" href="#scheduleGroup" role="button" data-slide="prev">
						<img src="{{ asset('img/left.png') }}" alt="left"/>        				
					</a>
					<a class="schedule-next" href="#scheduleGroup" role="button" data-slide="next">        				
						<img src="{{ asset('img/right.png') }}" alt="right"/>        				
					</a>
				</div>
				@endif
			</div>
			<a href="{{route('schedule')}}" class="btn btn-aldarull">Tots els concerts</a>
		</div>
	</div>
</section>
<section id="gallery" class="gallery">
	<h2 class="gallery-title">MULTIMEDIA</h2>
	<div class="center-section">
		<div class="gallery-container">
			@foreach($galleries as $gallery)
			<div class="col-6 col-sm-6 col-md-3 gallery-item venobox" data-gall="myGallery" data-href="{{ asset('/storage/').$gallery->url}}">
				<img src="{{ asset('/storage/').$gallery->thumb_url}}" class="img-fluid" alt="{{ $gallery->name}}" />
			</div>
			@endforeach
		</div>
		<a href="{{route('gallery')}}" class="btn btn-aldarull">Tota la galeria</a>
	</div>
</section>
<section id="shop" class="shop">
	<h2 class="shop-title">TENDA</h2>
	<div class="center-section">
		<div class="shop-container">
			@foreach($products as $product)
			<div class="col-12 col-sm-4 shop-item">
				<a href="{{route('product.show',$product->product_url)}}">
					<div id="product_{{$product->id}}" class="product" product-id="{{$product->id}}">
						<img src="{{ asset('/storage/').'/'.$product->img_url}}" class="img-fluid" alt="{{ $gallery->name}}"/>
						<div class="product-info">
							<div class="product-name">{{$product->name}}</div>
							<div class="product-price">{{$product->price}} €</div>
						</div>						
					</div>
				</a>
			</div>
			@endforeach
		</div>
		<a href="{{route('shop')}}" class="btn btn-aldarull">A la tenda</a>
	</div>
</section>
@endsection