@extends('admin.layouts.admin', ['body_class' => 'product'])
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
	<a class="btn btn-outline-info" role="button" href="{{route('admin.product.create')}}"><i class="fa fa-plus-alt"></i>Crear</a>
</div>
<br/>
<table class="table table-bordered" id="product-table">
	<thead>
		<tr>
			<th>Id</th>
			<th>Producte</th>
			<th>Descripció</th>
			<th>Preu</th>
			<th>Imatge</th>
			<th>Enllaç producte</th>
			<th>Actiu</th>
			<th>Activar</th>		
			<th>Editar</th>
			<th>Eliminar</th>
		</tr>
	</thead>
</table>
@endsection
@push('scripts')
<script>
	var datatable;
	datatable = $('#product-table').DataTable({
		processing: true,
		serverSide: true,
		ajax: '{{route('admin.product.data')}}',
		columns: [
		{ data: 'id'},
		{ data: 'name'},
		{ data: null},
		{ data: 'price'},
		{ data: null},
		{ data: null},
		{data: 'active'},
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
			targets: [2],
			type:'html',
			render: function(data){
				var text = data['description'];	
				return $("<div/>").html(text).text();
			}
		},
		{
			targets: [4],
			searchable: false,
			orderable: false,
			render: function (data) {                
				var img = data["img_url"];                
				return '<img src="{{asset('/storage/')}}/'+img+'" class="img-fluid" style="width:350px" />';
			}
		},
		{
			targets: [5],
			render: function(data){
				var product_url = data['product_url'];		
				if(product_url!=""){	
					var url = '{{ route("product.show", "url") }}';
					url = url.replace('url', product_url);
					return '<a href="'+url+'">'+url+'</a>';	
				} 		
				else
					return "";
			}
		},
		{
			targets: [6],
			render: function (data) {
				if (data == "0")
					color = "red";
				else
					color = "green";
				return '<div class="center-block" style="background-color:' + color + '; width:25px; height:25px;border-radius:100%"></div>';
			}
		},
		{
			targets: [7],
			render: function (data) {
				if (data["active"] == "0")
					activo = "Activar";
				else
					activo = "Desactivar";
				return '<button class="btn btn-secondary" accion="activar">' + activo + '</button>';

			}
		},
		{
			targets: [8],
			render: function(data){
				var id = data['id'];	
				var url = '{{ route("admin.product.edit", "id") }}';
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
			var url = '{{ route("admin.product.delete", "id") }}';
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
		case "activar":
		{
			var $id = data["id"];
			var $active = data["active"];
			var $activate = 0;
			if($active=="0")
				$activate = 1;

			var param = {'id':$id,'activate':$activate};
			var url = '{{route('admin.product.activate')}}';
			$.ajax({
				data: param,
				url: url,
				type: 'POST',
				success: function () {
					$('#product-table').DataTable().ajax.reload();
					if($activate==1)
						var alert="<div id='custom-alert' class='alert alert-success'>Event Activat</div>";
					else
						var alert="<div id='custom-alert' class='alert alert-warning'>Event Desactivat</div>";
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