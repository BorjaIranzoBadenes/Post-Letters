<x-layout>
    <div class="container my-5" style="height: 120vh">
        <div class="row justify-content-around">
            <div class="col-12 text-center">
                <div class="card blue-body" style="color: white;">
                    <img src="{{ Storage::url($article->image) }}" class="card-img-top img-fluid" alt="Imagen del artículo" style="max-width: 100%; max-height: 400px;">
                    <div class="card-body blue-body">
                        <h5 class="card-title">{{ $article->title }}</h5>
                        <p class="card-text">{{ $article->subtitle }}</p>
                        <div class="d-flex justify-content-between">
                            <span style="color: white">Publicado el {{ $article->created_at->format('d/m/Y') }} por {{ $article->user->name }}</span>
                            <span class="small fst-italic" style="color: white;"><i class="fas fa-clock"></i> {{ $article->readDuration() }} min</span>
                        </div>
                    </div>
                </div>
                <div class="card blue-body mt-3" style="color: white;">
                    <div class="card-body blue-body">
                        <p class="card-text" style="text-align: left;">{{ $article->body }}</p>
                    </div>
                    <div class="d-flex justify-content-center">
                        @if(Auth::user() && Auth::user()->is_revisor)
                            <a href="{{ route('revisor.acceptArticle', compact('article')) }}" class="btn btn-success text-white my-5 text-left me-4">Aceptar</a>
                            <a href="{{ route('revisor.rejectArticle', compact('article')) }}" class="btn btn-danger text-white my-5 text-right ms-4">Rechazar</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-5">
            <h3>Artículos relacionados</h3>
            @if($relatedArticles->isEmpty())
                <p>No hay artículos relacionados disponibles.</p>
            @else
                <div class="row">
                    @foreach($relatedArticles as $relatedArticle)
                    <div class="col-md-4 mb-5 mt-5" style="height: 50vh">
                        <a href="{{ route('article.show', $relatedArticle) }}" class="card blue-body text-decoration-none" style="color: white;">
                            <img src="{{ Storage::url($relatedArticle->image) }}" class="card-img-top img-fluid" style="max-width: 100%; max-height: 250px;" alt="Imagen del artículo">
                            <div class="card-body blue-body text-white text-center">
                                <h5 class="card-title">{{ $relatedArticle->title }}</h5>
                                <p class="card-text">{{ $relatedArticle->subtitle }}</p>
                                <p class="small text-muted fst-italic">
                                    <span class="text-white">{{ $relatedArticle->category->name }}</span>
                                </p>
                            </div>
                            <div class="card-footer blue-body text-muted d-flex justify-content-between align-items-center">
                                <span style="color: white">Publicado el {{ $relatedArticle->created_at->format('d/m/Y') }} por {{ $relatedArticle->user->name }}</span>
                                <span class="small fst-italic" style="color: white;"><i class="fas fa-clock"></i> {{ $relatedArticle->readDuration() }} min</span>
                            </div>
                            <p class="small fst-italic blue-body text-center">
                                @foreach ($relatedArticle->tags as $tag)
                                    <span class="text-white text-left">#{{ $tag->name }}</span>
                                @endforeach
                            </p>
                        </a>
                    </div>
                    @endforeach

                </div>
            @endif
        </div>
    </div>
</x-layout>
