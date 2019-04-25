<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{'/'}}" style="color:#777">
            <img class="brand-logo" src="{{ asset('img/aldarull-title.png') }}" alt="Logo" style="width:90px;" />
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item {{ Route::is('admin.cover.index') ? 'active' : '' }}">
                    <a class="nav-link" href="{{route('admin.cover.index')}}">GESTIÓ PORTADA</a>
                </li>
                <li class="nav-item {{ Route::is('admin.page.index') ? 'active' : '' }}">
                    <a class="nav-link" href="{{route('admin.page.index')}}">GESTIÓ PAGINES</a>
                </li>
                <li class="nav-item {{ Route::is('admin.schedule.index') ? 'active' : '' }}">
                    <a class="nav-link" href="{{route('admin.schedule.index')}}">GESTIÓ AGENDA</a>
                </li>
                <li class="nav-item {{ Route::is('admin.gallery.index') ? 'active' : '' }}">
                    <a class="nav-link" href="{{route('admin.gallery.index')}}">GESTIÓ MULTIMEDIA</a>
                </li>
                <li class="nav-item {{ Route::is('admin.product.index') ? 'active' : '' }}">
                    <a class="nav-link" href="{{route('admin.product.index')}}">GESTIÓ PRODUCTES</a>
                </li>
                <li class="nav-item {{ Route::is('admin.product.extra.index') ? 'active' : '' }}">
                    <a class="nav-link" href="{{route('admin.product.extra.index')}}">GESTIÓ EXTRES</a>
                </li>
                <li class="nav-item {{ Route::is('admin.product.extraType.index') ? 'active' : '' }}">
                    <a class="nav-link" href="{{route('admin.product.extraType.index')}}">GESTIÓ TIPUS EXTRES</a>
                </li>
                <li class="nav-item {{ Route::is('admin.download.index') ? 'active' : '' }}">
                    <a class="nav-link" href="{{route('admin.download.index')}}">GESTIÓ DESCARREGUES</a>
                </li>

                <li class="nav-item {{ Route::is('admin.resource.index') ? 'active' : '' }}">
                    <a class="nav-link" href="{{route('admin.resource.index')}}">GESTIÓ TEXTOS</a>
                </li>
            </ul>
            <ul class="navbar-nav navbar-right">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">                        
                        {{Auth::user()->name}}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <hr/>
                        <div class="dropdown-item">
                            <form action="{{ url('/logout') }}" method="POST" style="display:inline">
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-link nav-link" style="display:inline;cursor:pointer">
                                    Tancar sessió
                                </button>
                            </form>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>