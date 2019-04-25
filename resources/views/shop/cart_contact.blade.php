@extends('layouts.master', ['body_class' => 'cart info'])
@section('css')

@endsection
@section('content')
<section class="cart-contact-container">
    <h1 class="section-title">Dades de l'enviament</h1>
    <div class="center-section"> 
        <div class="cart-contact-info">
            <form action="{{ url('cistella/finalitzar')}}" method="POST">
                {!! csrf_field() !!}      
                <div class="cart-contact-user">
                    <div class="form-group col-sm-12 col-md-6">
                        <input type="text" name="input_name" class="form-control" id="input_name" placeholder="Nom Complert" value="{{ old('input_name') }}">
                        <span class="text-danger">{{ $errors->first('input_name') }}</span>
                    </div>
                    <div class="form-group col-sm-12 col-md-6">
                        <input type="email" name="input_email" class="form-control" id="input_email" placeholder="E-mail"  value="{{ old('input_email') }}">
                        <span class="text-danger">{{ $errors->first('input_email') }}</span>
                    </div>
                    <div class="form-group col-sm-12 col-md-12">  
                        <label class="labl">                            
                            <input type="radio" name="input_payment" value="concert" <?php echo (old('input_payment') == 'concert' ? 'checked' : ''); ?> <?php echo (old('input_payment') == null ? 'checked' : ''); ?> />
                            <div>En concert</div>
                            <div class="info-extra">Pots reservar i recollir en els nostres concerts!</div>
                        </label>    
                        <label class="labl">
                            <input type="radio" name="input_payment" value="reemborsament" <?php echo (old('input_payment') == 'reemborsament' ? 'checked' : ''); ?> />
                            <div>Compra online</div>
                            <div class="info-extra">Si no pots venir, utilitza el contra reemborsament!</div>
                        </label>    
                    </div>            
                    <div class="form-group col-sm-12 col-md-12 collapse" id="info-extra">
                        Al seleccionar l'enviament contra reembors, necesitem que ens indiquis les dades per fer l'enviament.
                        (+ despeses de gestió)
                        <div class="block delivery-address" id="delivery_address_group">
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <input type="text" id="input_address" name="input_address" class="form-control" placeholder="Adreça" value="{{ old('input_address') }}">
                                    <span class="text-danger">{{ $errors->first('input_address') }}</span>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <input type="text" id="input_address_2" name="input_address_2" class="form-control" placeholder="Adreça 2" value="{{ old('input_address_2') }}">
                                    <span class="text-danger">{{ $errors->first('input_address_2') }}</span>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <input type="text" id="input_postcode" name="input_postcode" class="form-control" placeholder="Codi postal" value="{{ old('input_postcode') }}">
                                    <span class="text-danger">{{ $errors->first('input_postcode') }}</span>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <input type="text" id="input_city" name="input_city" class="form-control" placeholder="Ciutat" value="{{ old('input_city') }}">
                                    <span class="text-danger">{{ $errors->first('input_city') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <input type="submit" class="btn btn-aldarull btn-lg" value="Finalitzar Comanda">
                <a class="cart" href="{{url('cistella')}}" rel="noindex">Tornar Enrrere</a>
                
            </form>

        </div>
    </div>
</section>
@endsection
@section('js')
<script>
    $(document).ready(function(){
        if ('<?php echo old('input_payment')?>' == 'reemborsament') {            
            $("#info-extra").collapse('show');
        }
        $("input[name='input_payment']").on('click',function(){
            tipus = $(this).val();
            if(tipus=='reemborsament'){
                $("#info-extra").collapse('show');                
            }
            else{
                $("#info-extra").collapse('hide');                
                $("#input_address").val('');
                $("#input_address_2").val('');
                $("#input_postcode").val('');
                $("#input_city").val('');
            }
        });
    });
</script>
@endsection