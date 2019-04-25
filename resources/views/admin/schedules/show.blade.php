@extends('admin.layouts.admin', ['body_class' => 'schedule show'])
@section('content')
<div class="row">
	<div class="col-sm-12">
		<h2>
			Event: {{$schedule->event}}						
		</h2>
		<div>
			Lloc: {{$schedule->location}}
		</div>		
		<div>
			Data: {{$schedule->event_date}}
		</div>		
		<div>
			Hora: {{$schedule->event_time}}
		</div>
		<div>
			Preu: @if($schedule->price==0) Gratuït @else  {{$schedule->price}} @endif
		</div>		
	</div>
</div>	
<div class="row">
	<div class="offset-sm-2 col-sm-4">
		<a class="btn btn-warning btn-block" role="button" href="{{route("admin.schedule.edit","$schedule->id")}}"><i class="fa fa-pencil-alt"></i>Editar</a>
	</div>
	<div class="col-sm-4">
		<a class="btn btn-outline-dark btn-block" role="button" href="{{route("admin.schedule.index")}}"><i class="fa fa-angle-left"></i>Tornar</a>
	</div>
</div>
@endsection
