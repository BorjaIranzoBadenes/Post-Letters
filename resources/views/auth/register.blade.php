<x-layout>
    <div class="container blue-body text-center text-white">
        <div class="row justify-content-center">
            <h1 class="display-1">
                Registrarse
            </h1>
        </div>
    </div> 
    
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8">
                @if ($errors->any())
                    <div class="alert alert-danger message-space">
                        <ul>
                            
                            @foreach($errors as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>

            <div style="height: 60vh">
            <form class="card p-5 shadow" action="{{ route('register') }}" method="post">
                @csrf

                <div class="mb-3">
                    <label for="username" class="form-label">Nombre:</label>
                    <input name="name" type="text" class="form-control" value="{{ old('name') }}">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Correo:</label>
                    <input name="email" type="email" class="form-control" value="{{ old('email') }}">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña:</label>
                    <input name="password" type="password" class="form-control" value="{{ old('password') }}">
                </div>
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirmar contraseña:</label>
                    <input name="password_confirmation" type="password" class="form-control" value="{{ old('password_confirmation') }}">
                </div>
                <div class="mt-2 text-center">
                    <button class="btn cool-blue text-white">Registrarse</button>
                    <p class="small mt-2">¿Estás ya registrado?<a class="text-decoration-none ms-2" href="{{ route('login') }}">Click aqui</a></p>
                </div>
            </form>
            </div>
        </div>
    </div>
</x-layout>