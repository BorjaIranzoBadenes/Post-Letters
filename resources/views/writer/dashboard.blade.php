<x-layout>
    <div class="container p-5 blue-body text-white text-center">
        <div class="row justify-content-center">
            <h1 class="display-1">
                Bienvenido Redactor
            </h1>
        </div>
    </div>
        @if (session('message'))
            <div class="alert alert-success text-center">
                {{ session('message') }}
            </div>
        @endif

        <div class="container my-5 text-dark">
            <div class="row justify-content-center">
                <div class="col-12">
                    <h2>Artículos en fase de revision</h2>
                    <x-writer-articles-table :articles="$unrevisionedArticles" />
                </div>
            </div>
        </div>
        <div class="container my-5">
            <div class="row justify-content-center">
                <div class="col-12">
                    <h2>Artículos aceptados</h2>
                    <x-writer-articles-table :articles="$acceptedArticles" />
                </div>
            </div>
        </div>
        <div class="container my-5">
            <div class="row justify-content-center">
                <div class="col-12">
                    <h2>Artículos rechazados</h2>
                    <x-writer-articles-table :articles="$rejectedArticles" />
                </div>
            </div>
        </div>
</x-layout>