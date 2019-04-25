@extends('admin.layouts.admin', ['body_class' => 'gallery'])
@section('css')
<link href="{{ asset('/css/dropzone.css') }}" rel="stylesheet">
@stop
@section('js')
<script type='text/javascript' src='https://code.jquery.com/ui/1.12.1/jquery-ui.js'></script>
<script src="{{ asset('/js/admin/galeria.js') }}"></script>
<script src="{{ asset('/js/admin/dropzone.js') }}"></script>

@stop
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<input type="hidden" id="uploadUrl" value="{{route('admin.gallery.upload')}}"/>
<input type="hidden" id="saveUrl" value="{{route('admin.gallery.update') }}"/>
<input type="hidden" id="deleteUrl" value="{{route('admin.gallery.delete',['id'=>'idElement']) }}"/>
<input type="hidden" id="removeUrl" value="{{route('admin.gallery.remove',['id'=>'idElement']) }}"/>
<div class="container">

</div>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#inputFilesModal">
	Cargar Imagenes
</button>
<div id="#multimediaForm">	
	<ul id="fileList" class="fileList">
		@foreach ($galleries as $image)
		<li title="{{$image->name}}" position="{{$image->position}}" id="imgCont_{{$image->id}}" class="element-content ui-sortable-handle">
			<img src="{{ asset('/storage/').$image->thumb_url}}" class="img-fluid img-element">
			<div id="delete_{{$image->id}}" class="img-delete">
				<img src="{{ asset('img/delete.png')}}" class="img-fluid">
			</div>
		</li>
		@endforeach     
	</ul>
	<div class="form-group">					
		<input class="form-control" id="submitGallery" type="button" value="Actualitzar">
	</div>
</div>
<div id="loadingDiv" class="loadingDiv">
	<img src="{{ asset('img/loading.gif') }}" alt="loading">
</div>
<div class="modal fade" id="inputFilesModal" tabindex="-1" role="dialog" aria-labelledby="inputFilesModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="inputFilesModalLabel">Cargar imatges</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<p id="msg"></p>
				<input type="file" id="multiFiles" name="files[]" multiple="multiple"/>
			</div>
			<div class="modal-footer">
				<button id="upload" class="btn btn-primary">Carregar</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Tancar</button>
			</div>
		</div>
	</div>
</div>

@endsection