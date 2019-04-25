@extends('admin.layouts.admin', ['body_class' => 'resources create'])
@section('content')
@if ($errors->any())
<div class="alert alert-danger">
	<ul>
		@foreach ($errors->all() as $error)
		<li>{{ $error }}</li>
		@endforeach
	</ul>
</div>
@endif

<div class="row" style="margin-top:40px">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header text-center">
				Crear Recurs
			</div>
			<div class="card-body" style="padding:30px">
				<form enctype="multipart/form-data" method="post" action="{{action('ResourceController@Store')}}">
					{{ csrf_field() }}
							<div class="form-group">
								<label for="key">Clau</label>
								<input type="text" name="key" id="key" class="form-control" />
							</div>
							<div class="form-group">
								<label for="resource-ckeditor">Text</label>
								<textarea id="resource-ckeditor" name="value" class="form-control"></textarea>
							</div>
							<div class="form-group">
								<a class="btn btn-outline-dark" role="button" href="{{route("admin.resource.index")}}">
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
@push('scripts')
<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
<script>
	CKEDITOR.replace( 'resource-ckeditor' );
</script>
@endpush
