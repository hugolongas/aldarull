@extends('admin.layouts.admin', ['body_class' => 'resources'])
@section('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.css"/>
@stop
@section('js')
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.js"></script>
@stop
@section('content')
<table class="table table-bordered" id="resource-table">
	<thead>
		<tr>
			<th>Id</th>
			<th>Clau</th>
			<th>Text</th>
			<th>Editar</th>
		</tr>
	</thead>
</table>
@endsection
@push('scripts')
<script>
	var datatable;
	$(function() {
		datatable = $('#resource-table').DataTable({
			processing: true,
			serverSide: true,
			ajax: '{{route('admin.resource.data')}}',
			columns: [
			{ data: 'id'},
			{ data: 'key'},
			{ data: null},
			{ data: null}			
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
				var text = data['value'];	
				return $("<div/>").html(text).text();
			}
			},
			{
				targets: [3],
				render: function(data){
					var id = data['id'];	
					var url = '{{ route("admin.resource.edit", "id") }}';
					url = url.replace('id', id);				
					return '<a class="btn btn-info btn-block" role="button" href="'+url+'"><i class="fa fa-pencil-alt"></i>Editar</a>';
				}
			}
			]
		});
	});
</script>
@endpush