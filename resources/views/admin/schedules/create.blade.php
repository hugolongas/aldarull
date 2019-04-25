@extends('admin.layouts.admin', ['body_class' => 'schedule create'])
@section('content')

<div class="row" style="margin-top:40px">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header text-center">
				Crear Event
			</div>
			<div class="card-body" style="padding:30px">
				<form action="{{route('admin.schedule.store')}}" method="post" enctype="multipart/form-data">
					{{ csrf_field() }}
					<div class="row">
						<div class="col-sm-12">
							<div class="form-group">
								<label for="event">Event:</label>
								<input type="text" name="event" id="event" class="form-control">
							</div>
							<div class="form-group">
								<label for="location">Lloc:</label>
								<input type="text" name="location" id="location" class="form-control">
							</div>
							<div class="form-group">
								<label for="event_date">Data:</label>
								<input type="date" name="event_date" id="event_date" class="form-control">
							</div>
							<div class="form-group">
								<label for="event_time">Hora:</label>
								<input type="time" name="event_time" id="event_time" class="form-control">
							</div>
							<div class="form-group">
								<label for="price">Preu:</label>
								<input type="text" name="price" id="price" class="form-control">
							</div>
						</div>
					</div>
					<div class="form-group text-center">
						<a class="btn btn-outline-dark" role="button" href="{{route("admin.schedule.index")}}">
							<i class="fa fa-angle-left"></i> Tornar
						</a>
						<input class="btn btn-outline-primary" type="submit" value="Crear">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
