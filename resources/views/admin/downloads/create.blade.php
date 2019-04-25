@extends('admin.layouts.admin', ['body_class' => 'download create']) 
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
				Crear Descarrega
			</div>
			<div class="card-body" style="padding:30px">
				<form enctype="multipart/form-data" method="post" action="{{action('DownloadController@Store')}}">
					{{ csrf_field() }}
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="file_title">titol descarrega</label>
								<input type="text" name="file_title" id="file_title" class="form-control" />
							</div>
							<div class="form-group">
								<label for="file_desc">Descripció</label>
								<textarea id="file_desc" name="file_desc" class="form-control"></textarea>
							</div>
							<div class="form-group">
								<label for="file_url">Imatge</label>
								<input name="file_url" type="file" id="file_url" class="form-control" />
							</div>
							<div class="form-group">
								<a class="btn btn-outline-dark" role="button" href="{{route('admin.download.index')}}">
									<i class="fa fa-angle-left"></i> Tornar
								</a>
								<input class="btn btn-outline-primary" type="submit" value="Crear">
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