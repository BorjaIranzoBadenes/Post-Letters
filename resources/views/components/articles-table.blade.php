<table class="table table-striped table-hover border">
    <thead class="table-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Título</th>
            <th scope="col">Subtítulo</th>
            <th scope="col">Redactor</th>
            <th scope="col">Acción</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($articles as $article)
        <tr>
            <th scope="row">{{ $article->id }}</th>
            <td>{{ $article->title }}</td>
            <td>{{ $article->subtitle }}</td>
            <td>{{ $article->user->name }}</td>
            <td>
                @if (is_null($article->is_accepted))
                <a href="{{ route('article.show', compact('article')) }}" class="btn btn-success text-white">Leer artículo</a>
                @else
                <a href="{{ route('revisor.undoArticle', compact('article')) }}" class="btn cool-blue text-white">Informe para revisión</a>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>