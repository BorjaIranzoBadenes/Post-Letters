<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="{{ route('welcome') }}">Post Letters</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <!-- Enlaces de navegación aquí -->
                @auth
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Bienvenido {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @if(Auth::user()->is_admin)
                            <li><a href="{{ route('admin.dashboard') }}" class="dropdown-item">Panel de administración</a></li>
                        @endif
                        @if(Auth::user()->is_revisor)
                            <li><a href="{{ route('revisor.dashboard') }}" class="dropdown-item">Panel de revisión</a></li>
                        @endif
                        @if(Auth::user()->is_writer)
                            <li><a href="{{ route('writer.dashboard') }}" class="dropdown-item">Panel de redacción</a></li>
                        @endif
                        <li><a href="{{ route('profile') }}" class="dropdown-item">Perfil</a></li>
                        <li><a href="{{ route('article.create') }}" class="dropdown-item">Crear un artículo</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a href="#" class="dropdown-item" onclick="event.preventDefault(); document.querySelector('#form-logout').submit();">Salir</a></li>
                        <form action="{{ route('logout') }}" method="post" id="form-logout" class="d-none">
                            @csrf
                        </form>
                    </ul>
                </li>
                @endauth
                
                @guest
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        ¡Bienvenido Invitado!
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a href="{{ route('register') }}" class="dropdown-item">Registrarse</a></li>
                        <li><a href="{{ route('login') }}" class="dropdown-item">Iniciar Sesión</a></li>
                    </ul>
                </li>
                @endguest
            </ul>
            
            <!-- Div de categorías en dispositivos pequeños -->
            <div class="col-md-4 mb-4 category-list d-sm-block d-md-none">
                <div class="card blue-body">
                    <div class="card-body blue-body">
                        <h5 class="card-title text-white text-center" style="font-size: 2rem;">Categorías</h5>
                        <ul class="list-group">
                            @foreach ($categories as $category)
                                <li class="list-group-item categories text-center" style="font-size: 1.5rem;">
                                    <a href="{{ route('article.byCategory', ['category' => $category->id]) }}">{{ $category->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>



