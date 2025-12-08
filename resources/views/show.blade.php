<h2>{{ $article->titre }}</h2>

@if(session('success'))
    <p>{{ $article->contenu }}</p> {{-- Affiche tout l'article après paiement --}}
@else
    <p>{{ Str::limit($article->contenu, 100) }}...</p>
    <a href="{{ route('article.payer', ['id' => $article->id]) }}" class="btn btn-primary">Lire la suite</a>
@endif

@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif
