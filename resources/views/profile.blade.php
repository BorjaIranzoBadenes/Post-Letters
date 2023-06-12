<x-layout>
    <div class="container mt-5 mb-3 blue-body text-white text-center p-5">
        <h2>Artículos creados por {{ Auth::user()->name }}</h2>
    </div>

    <div class="container my-5">
        <div class="row">
            @if ($articles->isEmpty())
                <div class="col-12 text-center">
                    <p class="text-dark" style="height: 45vh">Aún no tienes artículos creados.</p>
                </div>
            @else
                @foreach ($articles as $article)
                    <div class="col-md-4 mb-5 mt-5" style="height: 50vh">
                        <a href="{{ route('article.show', $article) }}" class="card blue-body text-decoration-none" style="color: white;">
                            <img src="{{ Storage::url($article->image) }}" class="card-img-top img-fluid" style="max-width: 100%; max-height: 250px;" alt="Imagen del artículo">
                            <div class="card-body blue-body text-white text-center">
                                <h5 class="card-title">{{ $article->title }}</h5>
                                <p class="card-text">{{ $article->subtitle }}</p>
                                <p class="small text-muted fst-italic">
                                    <span class="text-white">{{ $article->category->name }}</span>
                                </p>
                            </div>
                            <div class="card-footer blue-body text-muted d-flex justify-content-between align-items-center">
                                <span style="color: white">Publicado el {{ $article->created_at->format('d/m/Y') }} por {{ $article->user->name }}</span>
                                <span class="small fst-italic" style="color: white;"><i class="fas fa-clock"></i> {{ $articles[count($articles) - 1]->readDuration() }} min</span>
                            </div>
                            <p class="small fst-italic blue-body text-center">
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
