<x-layout>

    <div class="container p-5 blue-body text-center text-white">
        <div class="row justify-content-center">
            <h1 class="display-1">
                Artículo nuevo
            </h1>
        </div>
    </div>


        @if(session('message'))
            <div class = "alert alert-success text-center">
                {{session('message')}}
            </div>
        @endif
    <div class="container my-5 text-left">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8">
                @if ($errors -> any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{route('article.store')}}" method="POST" enctype="multipart/form-data" class="card p-5 sahdow">
                @csrf

                <div class="mb-3">
                    <label for="title" class="form-label">Título: </label>
                    <input name="title" type="text" class="form-control" value="{{old('title')}}">
                </div>
                <div class="mb-3">
                    <label for="subtitle" class="form-label">Subtítulo: </label>
                    <input name="subtitle" type="text" class="form-control" value="{{old('subtitle')}}">
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Imagen: </label>
                    <input name="image" type="file" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="category" class="form-label">Categoría: </label>
                    <select name="category" id="category" class="form-control">
                        @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="tags" class="form-label">Etiquetas: </label>
                    <input name="tags" id="tags" class="form-control" value="{{ old('tags') }}">
                    <span class="small fst-italic">Divide cada etiqueta con una coma</span>
                </div>
                <div class="mb-3">
                    <label for="body" class="form-label">Cuerpo del texto: </label>
                    <textarea name="body" id="body" cols="30" rows="10" class="form-control">{{old('body')}}</textarea>
                </div>
                <div class="mt-2 text-center">
                    <button class="btn cool-blue text-white">Crear artículo</button>
                    <a href="{{route('welcome')}}" class="btn btn-outline-info">Volver a inicio</a>
                </div>
                </form>
            </div>
        </div>
    </div>
</x-layout>