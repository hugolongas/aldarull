@extends('layouts.master', ['body_class' => 'cart finish'])
@section('css')

@endsection
@section('content')
<section class="cart-container">
  <h1 class="section-title">Comanda finalitzada</h1>
  <div class="center-section"> 
      <div class="finish-text">
        <p>Benvolgut {{$name}},
        </p>
        <p>
          La seva comanda s'ha enregistrat correctament, en breus rebrà un email amb la confirmació de la seva comanda,
          Moltes Grácies.
          <br/>
          Grup Aldarull.
        </p>
      </div>
    </div>
  </div>
</section>
@endsection
@section('js')

@endsection