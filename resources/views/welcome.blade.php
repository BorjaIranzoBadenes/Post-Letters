<x-layout>
    <div class="container p-5 blue-body text-center text-white">
        <div class="row justify-content-center">
            <h1 class="display-1">
                Post Letters
            </h1>
        </div>
    </div>

    @if (session('message'))
    <div class="container alert alert-success text-center message-space">
        {{session('message')}}
    </div>
    @endif
    
    <div class="container mt-5 mb-3">
        <form action="{{ route('article.search') }}" method="GET" class="d-flex">
            <input type="search" name="query" placeholder="¿Qué estás buscando?" class="form-control search me-2" aria-label="Search">
            <button class="btn btn-outline-info lupa" type="submit">
                <i class="fas fa-search"></i>
            </button>
        </form>
    </div>

    <div class="container my-5">
        <div class="row">
            <div class="col-md-8 mb-4">
                @if (count($articles) > 0)
                    <div class="card blue-body text-decoration-none" style="color: white;">
                        <a href="{{ route('article.show', ['article' => $articles[0]->slug]) }}" class="text-decoration-none">
                            <img src="{{ Storage::url($articles[0]->image) }}" class="card-img-top img-fluid" style="max-width: 100%; max-height: 400px;" alt="Imagen del artículo">
                            <div class="card-body blue-body">
                                <h5 class="card-title text-white">{{ $articles[0]->title }}</h5>
                                <p class="card-text text-white">{{ $articles[0]->subtitle }}</p>
                                <p class="small text-muted fst-italic">
                                    <span class="text-light">{{ $articles[0]->category->name }}</span>
                                </p>
                            </div>
                            <div class="card-footer blue-body text-muted d-flex justify-content-between align-items-center text-white">
                                <span style="color: white">Publicado el {{ $articles[0]->created_at->format('d/m/Y') }} por {{ $articles[0]->user->name }}</span>
                                <span class="small fst-italic" style="color: white;"><i class="fas fa-clock"></i> {{ $articles[0]->readDuration() }} min</span>
                            </div>
                            <p class="small fst-italic blue-body">
                                @foreach ($articles[0]->tags as $tag)
                                    <span class="text-light ms-3">#{{ $tag->name }}</span>
                                @endforeach
                            </p>
                        </a>
                    </div>
                @endif
            </div>
            <div class="col-md-4 mb-4 category-list d-none d-md-block">
                <div class="card blue-body">
                    <div class="card-body blue-body">
                        <h5 class="card-title text-white text-center" style="font-size: 2rem;">Categorías</h5>
                        <ul class="list-group">
                            @foreach ($categories as $category)
                                <li class="list-group-item categories text-center" style="font-size: 1.5rem;">
                                    <a href="{{ route('article.byCategory', ['category' => $category->id]) }}">{{ $category->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="card blue-body mt-4" style="max-height: 200px; overflow-y: auto;">
                    <div class="card-body blue-body">
                        <h5 class="card-title text-white text-center" style="font-size: 2rem;">Tags</h5>
                        <div class="d-flex flex-wrap justify-content-center">
                            @foreach ($tags as $tag)
                                <span class="badge bg-light text-dark me-2 mb-2">#{{ $tag->name }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>                
            </div>
        </div>
        <div class="row">
            @foreach ($articles as $key => $article)
                @if ($key > 0)
                    <div class="col-md-4 mb-4">
                        <div class="card blue-body text-decoration-none" style="color: white;">
                            <a href="{{ route('article.show', ['article' => $article->slug]) }}" class="text-decoration-none">
                                <img src="{{ Storage::url($article->image) }}" class="card-img-top img-fluid" style="max-width: 100%; max-height: 250px;" alt="Imagen del artículo">
                                <div class="card-body blue-body">
                                    <h5 class="card-title text-white">{{ $article->title }}</h5>
                                    <p class="card-text text-white">{{ $article->subtitle }}</p>
                                    <p class="small text-muted fst-italic">
                                        <span class="text-light">{{ $article->category->name }}</span>
                                    </p>
                                </div>
                                <div class="card-footer blue-body text-muted d-flex justify-content-between align-items-center text-white">
                                    <span style="color: white">Publicado el {{ $article->created_at->format('d/m/Y') }} por {{ $article->user->name }}</span>
                                    <span class="small fst-italic" style="color: white;"><i class="fas fa-clock"></i> {{ $article->readDuration() }} min</span>
                                </div>
                                <p class="small fst-italic blue-body">
                                    @foreach ($article->tags as $tag)
                                        <span class="text-light ms-3">#{{ $tag->name }}</span>
                                    @endforeach
                                </p>
                            </a>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</x-layout>
