@extends('admin.layouts.admin', ['body_class' => 'home'])
@section('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.css"/>
@stop
@section('js')
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.js"></script>
@stop
@section('content')
<h1>Comandes</h1>
<br/>

<table class="table table-bordered" id="comanda-table">
	<thead>
		<tr>
			<th>Id</th>
			<th>Nom complert</th>
			<th>E-mail</th>
			<th>Adreça</th>
			<th>Adreça 2</th>
			<th>Codi postal</th>
			<th>Ciutat</th>
			<th>Tipus</th>
			<th>Estat</th>
			<th>Veure Comanda</th>
			<th>Finalitzar Comanda</th>
		</tr>
	</thead>
</table>
@endsection
@push('scripts')
<script>
	var datatable;
	$(function() {
		datatable = $('#comanda-table').DataTable({
			processing: true,
			serverSide: true,
			ajax: '{{route('admin.index.data')}}',
			columns: [
			{ data: 'id'},
			{ data: 'name'},
			{ data: 'email'},
			{ data: 'address'},
			{ data: 'address_2'},
			{ data: 'postcode'},
			{ data: 'city'},
			{ data: 'tipus'},
			{ data: 'process'},
			{data: null},
			{data: null}
			],
			columnDefs: [
			{
				targets: [0],
				visible: false,
				searchable: false
			},
			{
				targets: [9],
				render: function(data){
					var id = data['id'];	
					var url = '{{ route("admin.comanda.show", "id") }}';
					url = url.replace('id', id);				
					return '<a class="btn btn-info btn-block" role="button" href="'+url+'"><i class="fa fa-pencil-alt"></i>Consultar</a>';
				}
			},
			{
				targets: [10],
				render: function(data){
					var id = data['id'];
					var proces = data['process']	
					var url = '{{ route("admin.comanda.finish", "id") }}';
					url = url.replace('id', id);				

					if(proces!='en proces')
					{
						return '<a class="btn btn-success btn-block disabled" role="button" href="'+url+'" ><i class="fa fa-pencil-alt"></i>Finalitzar</a>';
					}
					return '<a class="btn btn-success btn-block" role="button" href="'+url+'" ><i class="fa fa-pencil-alt"></i>Finalitzar</a>';
				}
			}
			]
		});
	});
</script>
@endpush
