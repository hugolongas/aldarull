@extends('admin.layouts.admin', ['body_class' => 'comanda'])
@section('content')

Al fer clic en finalitzar, s'enviarà un email de confirmació al usuari per informar-lo que ja te el seu encarrec preparat, o enviat
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
<div>
	<form action="{{route('admin.comanda.close',['id'=>$comanda->id]) }}" method="post" enctype="multipart/form-data">
		{{ csrf_field() }}
		{{ method_field('PUT') }}
		<input type="hidden" value="{{$comanda->email}}" name="email"/>
		@if($comanda->tipus!='concert')
		<br/>
		<div class="form-group">
			<label for="confirmationCode">Codi d'enviament:</label>
			<input type="text" name="confirmationCode" id="confirmationCode" class="form-control" required="">
		</div>
		@endif
		<div class="form-group text-center">
			<a class="btn btn-outline-dark" role="button" href="{{route("admin.schedule.index")}}">
				<i class="fa fa-angle-left"></i> Tornar
			</a>
			<input class="btn btn-outline-primary" type="submit" value="Crear">
		</div>
	</form>
</div>
@endsection
