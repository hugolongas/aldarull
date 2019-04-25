@extends('admin.layouts.admin', ['body_class' => 'product_extra edit'])
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
				Editar Extra
			</div>
			<div class="card-body" style="padding:30px">
				<form enctype="multipart/form-data" method="post" action="{{route('admin.product.extra.update',['id'=>$extra->id]) }}">
					{{ csrf_field() }}
					{{ method_field('PUT') }}
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="input_type">Tipus</label>
								<select name="input_type" id="input_type">
									@foreach($extraTypes as $eType)
									<option {{ $eType->name == $extra->type ? 'selected' : '' }} value="{{$eType->name}}">{{$eType->name}}</option>
									@endforeach
								</select>
							</div>					
							<div class="form-group">
								<label for="input_value">Valor</label>
								<input type="text" name="input_value" id="input_value" class="form-control" value="{{$extra->value}}" />
							</div>							
							<div class="form-group">
								<a class="btn btn-outline-dark" role="button" href="{{route("admin.product.extra.index")}}">
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
