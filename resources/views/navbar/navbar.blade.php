<nav id="navbar" class=" navegacio navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" href="/">
        <img src="{{ asset('img/logo.png') }}" class="d-inline-block align-top img-fluid" alt="Aldarull"/>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
        aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link {{ Route::is('index') ? 'active' : '' }}" href="{{route('index')}}">INICI</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::is('weare') ? 'active' : '' }}" href="{{route('weare')}}">CONEIXE'NS</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::is('schedule') ? 'active' : '' }}" href="{{route('schedule')}}">AGENDA</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::is('gallery') ? 'active' : '' }}" href="{{route('gallery')}}">MULTIMÈDIA</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::is('shop') ? 'active' : '' }}" href="{{route('shop')}}">BOTIGA</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::is('download') ? 'active' : '' }}" href="{{route('download')}}">DESCÀRREGUES</a>
            </li>
            <li class="nav-item">
                    <a class="nav-link {{ Route::is('contact') ? 'active' : '' }}" href="{{route('contact')}}">CONTACTE</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="cart">
                    <div >
                        <span class="fa fa-shopping-cart"></span>
                        <?php echo (Cart::instance('default')->count(false)>0 ? '('.Cart::instance('default')->count(false).')' : ''); ?>
                    </div>
                </a>
            </li>
        </ul>
    </div>
</nav>