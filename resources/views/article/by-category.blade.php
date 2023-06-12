<x-layout>
    <div class="container p-5 blue-body text-center text-white">
        <div class="row justify-content-center">
            <h1 class="display-1">
                {{ $category->name }}
            </h1>
        </div>
    </div>

    <div class="container mt-5 mb-3">
        <form action="{{ route('article.byCategory', ['category' => $category->id]) }}" method="GET" class="d-flex">
            <input type="search" name="query" placeholder="¿Qué estás buscando?" class="form-control search me-2" aria-label="Search">
            <button class="btn btn-outline-info lupa" type="submit">
                <i class="fas fa-search"></i>
            </button>
        </form>
    </div>

    <div class="container my-5">
        <div class="row">
            @if ($articles->isEmpty())
                <div class="col-12 text-center">
                    <p class="text-dark" style="height: 45vh">Aún no tenemos artículos sobre esa categoría.</p>
                </div>
            @else
                @foreach ($articles as $article)
                    <div class="col-12 col-md-4 mb-4" style="height: 65vh">
                        <a href="{{ route('article.show', $article) }}" class="card blue-body text-decoration-none text-center" style="color: white;">
                            <img src="{{ Storage::url($article->image) }}" class="card-img-top" alt="Imagen del artículo">
                            <div class="card-body text-white">
                                <h5 class="card-title">{{ $article->title }}</h5>
                                <p class="card-text">{{ $article->subtitle }}</p>
                            </div>
                            <div class="card-footer text-muted d-flex justify-content-between align-items-center">
                                <span style="color: white">Publicado el {{ $article->created_at->format('d/m/Y') }} por {{ $article->user->name }}</span>
                                <span class="small fst-italic" style="color: white;"><i class="fas fa-clock"></i> {{ $articles[count($articles) - 1]->readDuration() }} min</span>
                            </div>
                            <p class="small fst-italic">
                                @foreach ($article->tags as $tag)
                                <span class="text-white text-left">#{{ $tag->name }}</span>
                                @endforeach
                            </p>
                        </a>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</x-layout>
