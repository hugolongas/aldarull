@extends('admin.layouts.admin', ['body_class' => 'resources edit'])
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
				Editar: {{$resource->key}}
			</div>
			<div class="card-body" style="padding:30px">
				<form enctype="multipart/form-data" method="post" action="{{route('admin.resource.update',['id'=>$resource->id]) }}">
					{{ csrf_field() }}
					{{ method_field('PUT') }}					
					<div class="form-group">
						<label for="text_input">Text</label>
						<textarea id="resource-ckeditor" name="text" class="form-control">{{$resource->value}}</textarea>
					</div>
					<div class="form-group">
						<a class="btn btn-outline-dark" role="button" href="{{route("admin.resource.index")}}">
							<i class="fa fa-angle-left"></i> Tornar
						</a>
						<input class="btn btn-outline-primary" type="submit" value="Actualitzar">
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
