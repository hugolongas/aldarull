@extends('admin.layouts.admin', ['body_class' => 'download edit']) 
@section('content') @if ($errors->any())
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
				Editar descarrega
			</div>
			<div class="card-body" style="padding:30px">
				<form enctype="multipart/form-data" method="post" action="{{route('admin.download.update',['id'=>$download->id]) }}">
					{{ csrf_field() }} {{ method_field('PUT') }}
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="file_title">titol descarrega</label>
								<input type="text" name="file_title" id="file_title" class="form-control" value="{{$download->file_title}}" />
							</div>
							<div class="form-group">
								<label for="file_desc">Descripció</label>
								<textarea id="file_desc" name="file_desc" class="form-control">{{$download->file_desc}}</textarea>
							</div>
							<div class="form-group">
								<label for="file_url">Fitxer:  <a href="{{ asset('/storage/').$download->file_url}}">{{$download->file_url}}</a></label>
								<input name="file_url" type="file" id="file_url" class="form-control" />
								<input type="hidden" name="previous_file" id="previous_file" value="{{$download->file_url}}" />
							</div>
							<div class="form-group">
								<a class="btn btn-outline-dark" role="button" href="{{route('admin.download.index')}}">
									<i class="fa fa-angle-left"></i> Tornar
								</a>
								<input class="btn btn-outline-primary" type="submit" value="Editar">
							</div>
						</div>
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
	CKEDITOR.replace('file_desc');

</script>

@endpush