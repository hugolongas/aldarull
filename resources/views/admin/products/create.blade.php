@extends('admin.layouts.admin', ['body_class' => 'product create'])
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
				Crear Producte
			</div>
			<div class="card-body" style="padding:30px">
				<form enctype="multipart/form-data" method="post" action="{{action('ProductController@Store')}}">
					{{ csrf_field() }}
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="input_name">Producte</label>
								<input type="text" name="input_name" id="input_name" class="form-control" />
							</div>					
							<div class="form-group">
								<label for="input_desc">Descripció</label>
								<textarea id="input_desc" name="input_desc" class="form-control"></textarea>
							</div>
							<div class="form-group">
								<label for="input_price">Preu</label>
								<input type="text" name="input_price" id="input_price" class="form-control" />
							</div>			
							<fieldset>
								Extres
								@foreach($extras->groupby('type') as $key => $value)
								<div class="form-group">
									<div class="type">{{$key}}</div>
									@foreach($extras->where('type',$key) as $extra)
									<div class="custom-control custom-checkbox custom-control-inline">
										<input type="checkbox" name="extra[]" class="custom-control-input" id="customCheck_{{$extra->id}}" value="{{$extra->id}}">
										<label class="custom-control-label" for="customCheck_{{$extra->id}}">{{$extra->value}}</label>
									</div>
									@endforeach
								</div>		
								@endforeach
							</fieldset>
							<div class="form-group">
								<a class="btn btn-outline-dark" role="button" href="{{route("admin.product.index")}}">
									<i class="fa fa-angle-left"></i> Tornar
								</a>
								<input class="btn btn-outline-primary" type="submit" value="Crear">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="input_img">Imatge</label>
								<input  name="input_img" type="file" id="input_img" onchange="readURL(this)" class="form-control" />
								<img id="img" src="{{ asset('img/no_preview.png') }}" alt="" />
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
	CKEDITOR.replace('input_desc');
</script>
@endpush
