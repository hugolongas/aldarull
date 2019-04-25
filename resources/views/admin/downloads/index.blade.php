@extends('admin.layouts.admin', ['body_class' => 'download']) 
@section('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.css" /> 
@stop 
@section('js')
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
 crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.js"></script>

@stop 
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="col-sm-2">
	<a class="btn btn-outline-info" role="button" href="{{route('admin.download.create')}}"><i class="fa fa-plus-alt"></i>Crear</a>
</div>
<br/>
<table class="table table-bordered" id="download-table">
	<thead>
		<tr>
			<th>Id</th>
			<th>Titol</th>
			<th>Fitxer</th>
			<th>Descripció</th>
			<th>Editar</th>
			<th>Eliminar</th>
		</tr>
	</thead>
</table>
@endsection
 @push('scripts')
<script>
	var datatable;
	datatable = $('#download-table').DataTable({
		processing: true,
		serverSide: true,
		ajax: '{{route('admin.download.data')}}',
		columns: [
		{ data: 'id'},
		{ data: 'file_title'},
		{ data: 'file_desc'},
		{data: null},
		{data: null},
		{data: null, defaultContent: '<button class="btn btn-secondary" accion="eliminar">Eliminar</button>'}
		],
		columnDefs: [
		{
			targets: [0],
			visible: false,
			searchable: false
		},
		{
			targets: [3],
			searchable: false,
			orderable: false,
			render: function (data) {                
				var file_url = data["file_url"];                
				return '<a href="{{asset('/storage/')}}/'+file_url+'" >'+file_url+'</a>';
			}
		},
		{
			targets: [4],
			render: function(data){
				var id = data['id'];	
				var url = '{{ route("admin.download.edit", "id") }}';
				url = url.replace('id', id);				
				return '<a class="btn btn-info btn-block" role="button" href="'+url+'"><i class="fa fa-pencil-alt"></i>Editar</a>';
			}
		}
		]
	});

	$('#download-table tbody').on('click', 'button', function () {
		var data = datatable.row($(this).parents('tr')).data();
		var accion = $(this).attr("accion");
		$.ajaxSetup({
			headers:
			{ 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
		});
		switch (accion)
		{
			case "eliminar":
			{	var id = data["id"];										
			var url = '{{ route("admin.download.delete", "id") }}';
			url = url.replace('id', id);
			$.ajax({					
				url: url,
				type: 'POST',
				success: function () {
					$('#download-table').DataTable().ajax.reload();
					var alert="<div id='custom-alert' class='alert alert-danger'>Descarrega Eliminada</div>";
					$("#main").prepend(alert);
					setTimeout(function(){
						$('#custom-alert').remove();
					}, 5000);
				}
			});
			break;
		}
	}
});

</script>

@endpush