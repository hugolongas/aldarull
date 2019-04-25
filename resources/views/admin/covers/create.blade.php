@extends('admin.layouts.admin', ['body_class' => 'cover create']) 
@section('css')
<link href="{{ asset('/css/cover.css') }}" rel="stylesheet"> 
@stop 
@section('content')
<section>
	<form enctype="multipart/form-data" method="post" action="{{route('admin.cover.store')}}">
		{{ csrf_field() }}
		<input type="text" value="{{$widget->id}}" name="widget_id" />
	@include('admin.covers.widgets.widget_'.$widget->widget_type)
		<div class="form-group">
			<a class="btn btn-outline-dark" role="button" href="{{route('admin.cover.index')}}">
							<i class="fa fa-angle-left"></i> Tornar
						</a>
			<input class="btn btn-outline-primary" type="submit" value="Crear">
		</div>
	</form>
</section>
@endsection