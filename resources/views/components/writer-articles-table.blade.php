<table class="table table-striped table-hover border">
    <thead class="table-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Título</th>
            <th scope="col">Subtítulo</th>
            <th scope="col">Categoría</th>
            <th scope="col">Tags</th>
            <th scope="col">Creado el</th>
            <th scope="col">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($articles as $article)
            <tr>
                <th scope="row">{{ $article->id }}</th>
                <td>{{ $article->title }}</td>
                <td>{{ $article->subtitle }}</td>
                <td>{{ $article->category->name ?? 'Sin categoría' }}</td>
                <td>
                    @foreach ($article->tags as $tag )
                        {{ $tag->name }},
                    @endforeach
                </td>
                <td>{{ $article->created_at->format('d/m/Y') }}</td>
                <td class="d-flex flex-column align-items-center">
                    <div class="btn-block">
                        <a href="{{ route('article.show', compact('article')) }}" class="btn btn-success text-white mb-1" style="width: 100%;">Leer</a>
                        <a href="{{ route('article.edit', compact('article')) }}" class="btn btn-warning text-white" style="width: 100%;">Modificar</a>
                        <form action="{{ route('article.destroy', compact('article')) }}" method="POST" class="d-inline">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger mt-1" style="width: 100%;">Eliminar</button>
                        </form>
                    </div>
                </td>
                
                
                
            </tr>
        @endforeach
    </tbody>
</table>