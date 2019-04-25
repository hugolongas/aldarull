@extends('layouts.master', ['body_class' => 'gallery'])
@section('css')
<link href="{{ asset('/css/venobox.css') }}" rel="stylesheet">
@stop
@section('js')
<script src="{{ asset('/js/venobox.js') }}"></script>
<script src="{{ asset('/js/home.js') }}"></script>
@stop
@section('content')
<section id="gallery">
	<h1 class="section-title">MULTIMÈDIA</h1>
	<div class="center-section">
		<div class="gallery-container">
			@foreach($galleries as $gallery)
			<div class="col-6 col-sm-6 col-md-3 gallery-item venobox" data-gall="myGallery" data-href="{{ asset('/storage/').$gallery->url}}" >
				<img src="{{ asset('/storage/').$gallery->thumb_url}}" class="img-fluid" alt="{{ $gallery->name}}"/>
			</div>
			@endforeach
		</div>
	</div>
</section>
@endsection