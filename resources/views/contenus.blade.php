@extends('layouts.app')

@section('title', 'Contenus Culturels - Patrimoine Bénin')

@section('content')
@php
    $contenus = $contenus ?? collect();
@endphp

<section class="page-header">
    <div class="container">
        <h1>{{ $pageTitle ?? 'Contenus Culturels' }}</h1>
        <p>Découvrez la richesse du patrimoine culturel immatériel du Bénin</p>
    </div>
</section>

<section class="content-filters">
    <div class="container">
        <div class="filter-tabs">
            <a href="/contenus" class="filter-tab {{ !isset($type) || $type === null ? 'active' : '' }}">Tous</a>
            <a href="/contenus/recettes" class="filter-tab {{ isset($type) && $type === 'recettes' ? 'active' : '' }}">Recettes</a>
            <a href="/contenus/histoires" class="filter-tab {{ isset($type) && $type === 'histoires' ? 'active' : '' }}">Histoires & Contes</a>
            <a href="/contenus/articles" class="filter-tab {{ isset($type) && $type === 'articles' ? 'active' : '' }}">Articles Culturels</a>
        </div>
    </div>
</section>

<section class="contents-section">
    <div class="container">
        @if($contenus && $contenus->count() > 0)
            <div class="contents-grid">
                @foreach($contenus as $contenu)
                    <div class="content-card">
                        <div class="content-image">
                            @if(!empty($contenu->photos))
                                @php
                                    if (is_string($contenu->photos)) {
                                        $photos = json_decode($contenu->photos, true);
                                    } else {
                                        $photos = $contenu->photos;
                                    }
                                    $firstPhoto = is_array($photos) ? ($photos[0] ?? null) : null;
                                @endphp
                                @if($firstPhoto)
                                    <img src="{{ asset($firstPhoto) }}" alt="{{ $contenu->titre }}">
                                @else
                                    <img src="{{ asset('css/default-image.jpg') }}" alt="{{ $contenu->titre }}">
                                @endif
                            @else
                                <img src="{{ asset('css/default-image.jpg') }}" alt="{{ $contenu->titre }}">
                            @endif
                            <span class="content-type">
                                @switch($contenu->id_type_contenu ?? 0)
                                    @case(1)
                                        Recette
                                        @break
                                    @case(2)
                                        Histoire
                                        @break
                                    @case(3)
                                        Article
                                        @break
                                    @default
                                        Contenu
                                @endswitch
                            </span>
                        </div>
                        <div class="content-info">
                            <h3>{{ $contenu->titre ?? 'Sans titre' }}</h3>
                            <p class="content-excerpt">
                                {{ Str::limit(strip_tags($contenu->texte ?? ''), 100) }}
                            </p>
                            <div class="content-meta">
                                @if($contenu->region && $contenu->region->nom_region)
                                    <span class="content-region">{{ $contenu->region->nom_region }}</span>
                                @endif
                                @if($contenu->langue && $contenu->langue->nom_langue)
                                    <span class="content-langue">{{ $contenu->langue->nom_langue }}</span>
                                @endif
                            </div>
                            <div class="content-actions">
                                <!-- CHANGÉ: Utiliser l'ID au lieu du slug -->
                                <a href="{{ route('contenus.show', $contenu->id_contenu) }}" class="btn btn-sm">
                                    Lire la suite
                                </a>
                                <div class="content-stats">
                                    <span><i class="fas fa-eye"></i> {{ $contenu->vues ?? 0 }}</span>
                                    <span><i class="fas fa-heart"></i> {{ $contenu->likes ?? 0 }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if($contenus->hasPages())
                <div class="pagination-wrapper">
                    {{ $contenus->links() }}
                </div>
            @endif
        @else
            <div class="no-content">
                <div class="text-center py-5">
                    <i class="fas fa-book-open fa-3x text-muted mb-3"></i>
                    <h3>Aucun contenu disponible</h3>
                    <p class="text-muted">
                        @if($contenus && $contenus->count() === 0)
                            Aucun contenu publié n'a été trouvé dans la base de données.
                        @else
                            Erreur de chargement des contenus.
                        @endif
                    </p>
                </div>
            </div>
        @endif
    </div>
</section>
@endsection