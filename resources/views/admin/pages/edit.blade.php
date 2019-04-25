@extends('admin.layouts.admin', ['body_class' => 'pages edit'])
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
				Crear Pagina
			</div>
			<div class="card-body" style="padding:30px">
				<form enctype="multipart/form-data" method="post" action="{{route('admin.page.update',['id'=>$page->id]) }}">
					{{ csrf_field() }}
					{{ method_field('PUT') }}
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="page_name_input">Nóm página</label>
								<input type="text" name="input_page_name" id="page_name_input" class="form-control" value="{{$page->page_name}}" />
							</div>
							<div class="form-group">
								<label for="title_input">Títol de la página</label>
								<input type="text" name="input_title" id="title_input" class="form-control" value="{{$page->page_title}}"/>
							</div>
							<div class="form-group">
								<label for="text_input">Text</label>
								<textarea id="article-ckeditor" name="input_text" class="form-control">{{$page->page_text}}</textarea>
							</div>
							<div class="form-group">
								<a class="btn btn-outline-dark" role="button" href="{{route("admin.page.index")}}">
									<i class="fa fa-angle-left"></i> Tornar
								</a>
								<input class="btn btn-outline-primary" type="submit" value="Actualitzar">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="imageInput">Imatge</label>
								<input  name="input_img" type="file" id="imageInput" onchange="readURL(this)" class="form-control" />
								<input type="hidden" name="previous_img" id="previous_img" value="{{$page->img_name}}" />
								<img id="img" src="{{ asset('/storage/').'/'.$page->img_url }}" class="img-fluid" alt="{{$page->img_name}}" />
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
<script type="text/javascript">
	function readURL(input) {
		var url = input.value;
		var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
		if (input.files && input.files[0]&& (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) {
			var reader = new FileReader();

			reader.onload = function (e) {
				$('#img').attr('src', e.target.result);
			}

			reader.readAsDataURL(input.files[0]);
		}else{
			$('#img').attr('{{ asset('img/no_preview.png') }}');
		}
	}
</script>
<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
<script>
	CKEDITOR.replace( 'article-ckeditor' );
</script>
@endpush
