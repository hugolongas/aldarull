@extends('admin.layouts.admin', ['body_class' => 'product_extra'])
@section('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.css"/>
@stop
@section('js')
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.js"></script>
@stop
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="col-sm-2">
	<a class="btn btn-outline-info" role="button" href="{{route('admin.product.extra.create')}}"><i class="fa fa-plus-alt"></i>Crear</a>
</div>
</br>
<table class="table table-bordered" id="extra-table">
	<thead>
		<tr>
			<th>Id</th>
			<th>Tipus</th>
			<th>Valor</th>
			<th>Editar</th>
			<th>Eliminar</th>
		</tr>
	</thead>
</table>
@endsection
@push('scripts')
<script>
	var datatable;
	datatable = $('#extra-table').DataTable({
		processing: true,
		serverSide: true,
		ajax: '{{route('admin.product.extra.data')}}',
		columns: [
		{ data: 'id'},
		{ data: 'type'},
		{ data: 'value'},
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
			render: function(data){
				var id = data['id'];	
				var url = '{{ route("admin.product.extra.edit", "id") }}';
				url = url.replace('id', id);				
				return '<a class="btn btn-info btn-block" role="button" href="'+url+'"><i class="fa fa-pencil-alt"></i>Editar</a>';
			}
		}
		]
	});

	$('#product-table tbody').on('click', 'button', function () {
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
			var url = '{{ route("admin.product.extra.delete", "id") }}';
			url = url.replace('id', id);
			$.ajax({					
				url: url,
				type: 'POST',
				success: function () {
					$('#product-table').DataTable().ajax.reload();
					var alert="<div id='custom-alert' class='alert alert-danger'>Event Eliminat</div>";
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