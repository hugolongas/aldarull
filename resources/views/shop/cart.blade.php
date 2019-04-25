@extends('layouts.master', ['body_class' => 'cart'])

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
@notification()
<section id="cart">
    <h1 class="section-title">CISTELLA</h1>
    <div class="center-section">
        <div class="cart-container">
            @if (sizeof(Cart::content()) > 0)
            @foreach (Cart::content() as $item)
            <div class="product-container">
                <div class="product-row col-6 col-sm-4">
                    <div class="col-12 col-sm-6 product-img">
                        <img src="{{ asset('storage/' . $item->model->img_url) }}" alt="product" class="img-fluid cart-image">
                    </div>
                    <div class="col-12 col-sm-6 product-name">
                        <a href="{{ url('botiga', [$item->model->product_url]) }}">{{ $item->name }}</a>
                        @if($item->options->count()>0)
                        @foreach($types as $type)
                        <p><?php echo ($item->options->has($type->name) ? $type->name.' '. $item->options[$type->name] : ''); ?></p>
                        @endforeach
                        @endif
                    </div>
                </div>
                <div class="product-row col-6 col-sm-8">
                    <div class="col-12 col-sm-3 product-qty">
                        <div>
                            <i class="fas fa-minus-circle changeQty" data-id="{{$item->rowId}}" data-type="lessQty" data-value="-1"></i>
                            <strong>{{$item->qty}}</strong>
                            <i class="fas fa-plus-circle changeQty" data-id="{{$item->rowId}}" data-type="moreQty" data-value="1"></i>
                        </div>
                    </div>
                    <div class="col-12 col-sm-3 product-price">
                        Preu: {{ $item->price }} €
                    </div>
                    <div class="d-12 col-sm-3 product-subtotal">
                        Subtotal: {{ $item->subtotal }} €
                    </div>
                    <div class="col-12 col-sm-3 product-remove">
                        <form action="{{ url('cistella', [$item->rowId]) }}" method="POST">
                            {!! csrf_field() !!}
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="submit" class="btn btn-outline-aldarull btn-sm" value="Eliminar">
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
            <div class="product-total">
                Total: {{ Cart::total() }} €
            </div>
                    <a href="{{ url('/cistella/dades')}}" rel="noindex" class="btn btn-aldarull"  style="display: block;float:right;margin-right:15px">Procedir amb el pagament</a>
            </div> 
        </div>                 

        @else
        <h3 class="cart-empty">No hi ha cap producte en la cistella</h3>
        <a href="{{ url('/botiga') }}" class="btn btn-aldarull">Tornar a la botiga</a>

        @endif
    </div> <!-- end container -->
</div>
</section>
@endsection

@section('js')
<script>
    (function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.changeQty').on('click', function() {
            var id = $(this).attr('data-id')
            var value = $(this).attr('data-value')
            $.ajax({
                type: "POST",
                url: '{{ url("/cistella") }}' + '/' + id,
                data: {
                    'value': value
                },
                success: function(data) {
                    window.location.href = '{{ url('/cistella') }}';
                }
            });
        });
    })();
</script>
@endsection