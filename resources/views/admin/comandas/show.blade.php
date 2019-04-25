@extends('admin.layouts.admin', ['body_class' => 'comanda'])
@section('content')

<div class="dades-usuari">
	Nom: {{$comanda->name}}<br/>
	Email: {{$comanda->email}}<br/>
	Tipus: {{$comanda->tipus}}<br/>
	Proces: <strong>{{$comanda->process}}</strong><br/>
	@if($comanda->city!='')
	Adreça: {{$comanda->address}} {{$comanda->address_2}}, {{$comanda->postcode}} {{$comanda->city}}
	@endif

</div>

<br/>
<table class="table table-striped">
	<thead>
		<tr>
			<th scope="col">Producte</th>
			<th scope="col">Extres</th>
			<th scope="col">Quantitat</th>
			<th scope="col">Preu</th>
			<th scope="col">Subtotal</th>
		</tr>
	</thead>
	<tbody>
		@foreach($cart as $item)
		<tr>
			<th scope="row">{{ $item->name }}</th>
			<td>@if($item->options->count()>0)
				@foreach($types as $type)
				<p><?php echo ($item->options->has($type->name) ? $type->name.' '. $item->options[$type->name] : ''); ?></p>
				@endforeach
			@endif</td>
			<td><strong>{{$item->qty}}</strong></td>
			<td>{{$item->price}}€</td>
			<td>{{$item->subtotal}}€</td>
		</tr>
		@endforeach
	</tbody>
	<tfooter>
		<th></th>
		<th scope="col"></th>
		<th scope="col"></th>
		<th scope="col">Total:</th>
		<th scope="col">{{$total}}€</th>
	</tfooter>
</table>
<div class="col-sm-4">
	<a class="btn btn-outline-dark btn-block" role="button" href="{{url('/')}}"><i class="fa fa-angle-left"></i>Tornar</a>
</div>
@endsection
@push('scripts')
@endpush
