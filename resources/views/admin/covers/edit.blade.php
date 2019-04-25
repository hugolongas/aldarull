@extends('admin.layouts.admin', ['body_class' => 'cover edit']) 
@section('css')
<link href="{{ asset('/css/cover.css') }}" rel="stylesheet"> 
@stop 
@section('content')
<section>
	<form enctype="multipart/form-data" method="post" action="{{route('admin.cover.update',['id'=>$cover->id])}}">
		{{ csrf_field() }} {{ method_field('PUT') }}
		<input type="text" value="{{$cover->widget_id}}" name="widget_id" />
		@include('admin.covers.widgets.widget_'.$cover->GetWidget()->widget_type,['cover'=>$cover])
		<div class="form-group">
			<a class="btn btn-outline-dark" role="button" href="{{route('admin.cover.index')}}">
				<i class="fa fa-angle-left"></i> Tornar
			</a>
			<input class="btn btn-outline-primary" type="submit" value="Actualitzar">
		</div>
	</form>
</section>
@endsection