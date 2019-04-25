@extends('admin.layouts.admin', ['body_class' => 'pages'])
@section('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.css"/>
@stop
@section('js')
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.js"></script>
@stop
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<table class="table table-bordered" id="product-table">
	<thead>
		<tr>
			<th>Id</th>
			<th>Nom Página</th>
			<th>Titol</th>
			<th>Text</th>
			<th>Imatge</th>
			<th>Veure</th>
			<th>Editar</th>
		</tr>
	</thead>
</table>
@endsection
@push('scripts')
<script>
	var datatable;
	$(function() {
		datatable = $('#product-table').DataTable({
			processing: true,
			serverSide: true,
			ajax: '{{route('admin.page.data')}}',
			columns: [
			{ data: 'id'},
			{ data: 'page_name'},
			{ data: 'page_title'},
			{ data: null},
			{ data: null},
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
				targets: [1],
				visible: false,
				searchable: false
			},
			{
				targets: [3],
				type:'html',
				render: function(data){
					var text = data['page_text'];	
					return $("<div/>").html(text).text();
				}
			},
			{
				targets: [4],
				searchable: false,
				orderable: false,
				render: function (data) {                
					var img = data["img_url"];										
					if(img!='')
					{
						return '<img src="{{'/storage/'}}/'+img+'" class="img-fluid" style="width:350px" />';	
					}       
					return '';
					
				}
			},
			{
				targets: [5],
				render: function(data){
					var id = data['id'];			
					var url = '{{ route("admin.page.show", "id") }}';
					url = url.replace('id', id); 		
					return '<a class="btn btn-secondary btn-block" role="button" href="'+url+'"><i class="fa fa-search-alt"></i>Veure</a>';
				}
			},
			{
				targets: [6],
				render: function(data){
					var id = data['id'];	
					var url = '{{ route("admin.page.edit", "id") }}';
					url = url.replace('id', id);				
					return '<a class="btn btn-info btn-block" role="button" href="'+url+'"><i class="fa fa-pencil-alt"></i>Editar</a>';
				}
			}
			]
		});
	});
</script>
@endpush