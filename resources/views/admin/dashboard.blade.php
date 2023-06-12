<x-layout>  
    <div class="container p-5 blue-body text-center text-white">
        <div class="row justify-content-center">
            <h1 class="display-1">
                Bienvenido, Administrador
            </h1>
        </div>
    </div>

    @if (session('message'))
        <div class="container alert alert-success text-center message-space">
            {{session('message')}}
        </div>
    @endif

    @if ($errors->any())
    <div class="container alert alert-danger text-center message-space">
        <ul class="list-unstyled">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2>Solicitudes por función de administrador</h2>
                <x-requests-table :roleRequests="$adminRequests" role="administrador" />
            </div>
        </div>
    </div>

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2>Solicitudes por función de revisor</h2>
                <x-requests-table :roleRequests="$revisorRequests" role="revisor" />
            </div>
        </div>
    </div>

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2>Solicitudes por función de redactor</h2>
                <x-requests-table :roleRequests="$writerRequests" role="redactor" />
            </div>
        </div>
    </div>

    <hr style="width: 60%; margin-left: auto; margin-right: auto;">
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2>Los tags de la plataforma</h2>
                <x-metainfo-table :metaInfos="$tags" metaType="tags" />
            </div>
        </div>
    </div>

    <hr style="width: 60%; margin-left: auto; margin-right: auto;">
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2>Las categorías de la plataforma</h2>
                <x-metainfo-table :metaInfos="$categories" metaType="category" />
                <form action="{{ route('admin.storeCategory') }}" method="POST" class="d-flex">
                    @csrf
                    <input type="text" name="name" class="form-control me-2" placeholder="Añadir nueva categoría">
                    <button type="submit" class="btn btn-success text-white">Añadir</button>
                </form>
            </div>
        </div>
    </div>
</x-layout>