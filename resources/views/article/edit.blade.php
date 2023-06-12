<x-layout>
    <div class="container p-5 blue-body text-center text-white">
        <div class="row justify-content-center">
            <h1 class="display-1">
                Modificar el artículo
            </h1>
        </div>
    </div>

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="container text-left">
        <form action="{{ route('article.update', $article) }}" method="POST" enctype="multipart/form-data" class="card p-5 shadow">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="title" class="form-label">Título: </label>
                <input name="title" type="text" class="form-control" id="title" value="{{ $article->title }}">
            </div>
            <div class="mb-3">
                <label for="subtitle" class="form-label">Subtítulo: </label>
                <input name="subtitle" type="text" class="form-control" id="subtitle" value="{{ $article->subtitle }}">
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Imagen: </label>
                <input name="image" type="file" class="form-control" id="image">
            </div>
            <div class="mb-3">
                <label for="category" class="form-label">Categoría: </label>
                <select name="category" class="form-control" id="category">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" @if($article->category && $category->id === $article->category->id) selected @endif>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="body" class="form-label">Descripción</label>
                <textarea name="body" id="body" cols="30" rows="10" class="form-control">{{ $article->body }}</textarea>
            </div>
            <div class="mb-3">
                <label for="tags" class="form-label">Etiquetas: </label>
                <input name="tags" id="tags" class="form-control" value="{{ $article->tags->implode('name', ',') }}">
                <span class="small fst-italic">Divide las etiquetas con una coma</span>
            </div>
            <div class="mt-2 text-center">
                <button class="btn cool-blue text-white">Añadir un artículo</button>
                <a href="{{ route('welcome') }}" class="btn btn-outline-info">Volver al inicio</a>
            </div>
        </form>
    </div>
</x-layout>
