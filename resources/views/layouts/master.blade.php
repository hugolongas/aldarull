<!doctype html>
<html lang="es">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
  <link href="{{ asset('/css/main.min.css') }}" rel="stylesheet"> @yield('css')
  <title>{{ config('app.name', 'Laravel') }}</title>
</head>

<body>
  <main id="main" class="warpper {{ $body_class or '' }}">
  @include('navbar.navbar') @notification() @yield('content')
    <div id="sidebar" class="sidebar">
      <a id="close-cart" href="javascript:void(0)" class="closebtn">&times;</a>
      <ul class="dropdown-cart" role="menu">
        @if (sizeof(Cart::content()) > 0) @foreach(Cart::content() as $item)
        <li>
          <span class="item">
                <span class="item-left">
                    <img src="{{ asset('storage/' . $item->model->img_url) }}" alt="product" class="img-fluid cart-image" width="50px">
                    <span class="item-info">
                        <span>{{$item->model->name}}</span>
          <span>{{$item->model->price}}€</span>
          </span>
          </span>
          <span class="item-right">
                    <button class="btn btn-xs btn-danger pull-right">x</button>
                </span>
          </span>
        </li>
        @endforeach @endif
        <div class="dropdown-divider"></div>
        <li>
          <a href="{{url('cistella')}}">
            <div class="text-center">Anar a la cistella</div>
          </a>
        </li>
      </ul>
    </div>
  </main>
  <footer>
    @include('footer_contact')
    <div class="footer">
      <div class="footer-right">
        <a href="{{url('/politica-cookies.html')}}" target="_blank">Política de cookies</a> /
        <a href="{{url('/politica-privacitat.html')}}" target="_blank">Política de privacitat</a>
      </div>
    </div>
  </footer>
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
  <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>

  <script src="{{ asset('/js/main.js') }}"></script>
  @yield('js')
</body>

</html>