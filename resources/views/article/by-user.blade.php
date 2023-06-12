<x-layout>
    <div class="container blue-body">
        <h1>Artículos de {{ $user->name }}</h1>
        
        <div class="row">
            @foreach ($articles as $article)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ Storage::url($article->image) }}" class="card-img-top" alt="Imagen del artículo">
                        <div class="card-body">
                            <h5 class="card-title">{{ $article->title }}</h5>
                            <p class="card-text">{{ $article->description }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-layout>








