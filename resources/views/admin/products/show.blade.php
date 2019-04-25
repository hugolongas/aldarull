@extends('admin.layouts.admin', ['body_class' => 'product show'])
@section('content')
<div class="row" style="margin-top:40px">
	<div class="col-md-8">
		<div>
			<h3>Nóm página:</h3>
			<h2> {{$page->page_name}}</h2>
		</div>
		<div>
			<h3>Títol de la página:</h3>
			<h2>{{$page->page_title}}</h2>
		</div>
		<div>
			<h2>Text</h2>
		</span>{!! $page->page_text !!}</span>
	</div>		
</div>
<div class="col-md-4">		
	<img id="img" class="img-fluid" src="{{ asset('img/gallery/').'/'.$page->page_img }}" alt="{{$page->page_img}}" />
</div>
</div>
<div class="row">
	<div class="offset-sm-2 col-sm-4">
		<a class="btn btn-warning btn-block" role="button" href="{{route("admin.page.edit","$page->id")}}"><i class="fa fa-pencil-alt"></i>Editar</a>
	</div>
	<div class="col-sm-4">
		<a class="btn btn-outline-dark btn-block" role="button" href="{{route("admin.page.index")}}"><i class="fa fa-angle-left"></i>Tornar</a>
	</div>
</div>
@endsection
@push('scripts')
@endpush
