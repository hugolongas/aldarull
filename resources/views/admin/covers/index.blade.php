@extends('admin.layouts.admin', ['body_class' => 'cover']) 
@section('content')
<section>
	<meta name="csrf-token" content="{{ csrf_token() }}">	
	<section class="slider-container">
		<h2>Slider portada</h2>
		<div class="row widget-buttons">
			@foreach($widgets as $widget)
				<div class="col-sm-4">
					<a class="btn btn-info btn-block" role="button" href="{{route('admin.cover.create',['id'=>$widget->id]) }}"><i class="fa fa-plus-alt"></i>Crear {{$widget->widget_type}}</a>
				</div>
			@endforeach
		</div>
		<div class="widget-container">
			@foreach($covers as $cover)
				@include('admin.covers.widget',array('cover',$cover)) 
			@endforeach
		</div>
	</section>
	<hr/>
	<section class="conexiens-container">
		<h2>Coneixe'ns</h2><a class="btn btn-info" role="button" href="{{ route("admin.resource.edit",2) }}"><i class="fa fa-plus-alt"></i>Editar</a>
		<div class="conexiens-text">
			{!!Resources::GetResource('portada.coneixens.text')!!}				
		</div>		
	</section>
</section>
@endsection
 @push('scripts')
<script>
$(function(){
$('.eliminar-widget').on('click', function () {		
	var id = $(this).attr("data-id");
	$.ajaxSetup({
			headers:
			{ 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
		});							
	var url = '{{ route("admin.cover.delete", "id") }}';
	url = url.replace('id', id);
	$.ajax({					
		url: url,
		type: 'POST',
		success: function () {
			var alert="<div id='custom-alert' class='alert alert-danger'>Slide Eliminat</div>";
			$("#"+id).remove();
			$("#main").prepend(alert);
				setTimeout(function(){
				$('#custom-alert').remove();
			}, 5000);
			window.location.href = '{{ url('/portada') }}';
		}
	});
});
});
</script>
@endpush