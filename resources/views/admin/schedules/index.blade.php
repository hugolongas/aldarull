@extends('admin.layouts.admin', ['body_class' => 'schedule'])
@section('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.css"/>
@stop
@section('js')
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.js"></script>
@stop
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="col-sm-4">
	<a class="btn btn-info btn-block" role="button" href="{{route('admin.schedule.create')}}"><i class="fa fa-plus-alt"></i>Crear</a>
</div>
</br>
<table class="table table-bordered" id="shcedule-table">
	<thead>
		<tr>
			<th>Id</th>
			<th>Event</th>
			<th>Lloc</th>
			<th>Data Event</th>
			<th>Hora Event</th>
			<th>Preu</th>
			<th>Actiu</th>
			<th>Activar</th>
			<th>Veure</th>
			<th>Editar</th>
			<th>Eliminar</th>
		</tr>
	</thead>
</table>
@endsection
@push('scripts')
<script>
	var datatable;
	$(function() {
		datatable = $('#shcedule-table').DataTable({
			processing: true,
			serverSide: true,
			ajax: '{{route('admin.schedule.data')}}',
			columns: [
			{ data: 'id'},
			{ data: 'event'},
			{ data: 'location'},
			{ data: 'event_date'},
			{ data: 'event_time'},
			{ data: 'price'},
			{ data: 'active'},
			{data: null, defaultContent: '<button class="btn btn-secondary" accion="activar">Activar</button>'},
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
					var url = '{{ route("admin.schedule.show", "id") }}';
					url = url.replace('id', id); 		
					return '<a class="btn btn-secondary btn-block" role="button" href="'+url+'"><i class="fa fa-search-alt"></i>Veure</a>';
				}
			},
			{
				targets: [9],
				render: function(data){
					var id = data['id'];	
					var url = '{{ route("admin.schedule.edit", "id") }}';
					url = url.replace('id', id);				
					return '<a class="btn btn-info btn-block" role="button" href="'+url+'"><i class="fa fa-pencil-alt"></i>Editar</a>';
				}
			}
			]
		});

		$('#shcedule-table tbody').on('click', 'button', function () {
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
				var url = '{{ route("admin.schedule.delete", "id") }}';
				url = url.replace('id', id);
				$.ajax({					
					url: url,
					type: 'POST',
					success: function () {
						$('#shcedule-table').DataTable().ajax.reload();
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
				var url = '{{route('admin.schedule.activate')}}';
				$.ajax({
					data: param,
					url: url,
					type: 'POST',
					success: function () {
						$('#shcedule-table').DataTable().ajax.reload();
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
	});
</script>
@endpush