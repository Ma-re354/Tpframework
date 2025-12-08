@extends('layouts.app')

@section('title', $region->nom_region . ' - Patrimoine Bénin')

@section('content')
<section class="region-detail-section">
    <div class="container">
        <!-- En-tête de la région -->
        <div class="region-header-epure">
            <div class="region-icon-large">
                <i class="fas fa-map-marked-alt"></i>
            </div>
            <div class="region-header-content">
                <h1>{{ $region->nom_region }}</h1>
                @if($region->localisation)
                <p class="region-location">
                    <i class="fas fa-compass"></i> {{ $region->localisation }}
                </p>
                @endif
            </div>
        </div>

        <!-- Métriques de la région -->
        <!-- <div class="region-metrics-grid">
            @if($region->population)
            <div class="metric-card">
                <div class="metric-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="metric-content">
                    <h3>{{ number_format($region->population, 0, ',', ' ') }}</h3>
                    <p>Habitants</p>
                </div>
            </div>
            @endif

            @if($region->superficie)
            <div class="metric-card">
                <div class="metric-icon">
                    <i class="fas fa-expand-arrows-alt"></i>
                </div>
                <div class="metric-content">
                    <h3>{{ number_format($region->superficie, 0, ',', ' ') }} km²</h3>
                    <p>Superficie</p>
                </div>
            </div>
            @endif

            <div class="metric-card">
                <div class="metric-icon">
                    <i class="fas fa-book-open"></i>
                </div>
                <div class="metric-content">
                    <h3>{{ $region->contenus_count ?? 0 }}</h3>
                    <p>Contenus</p>
                </div>
            </div>

            <div class="metric-card">
                <div class="metric-icon">
                    <i class="fas fa-calendar-alt"></i>
                </div>
                <div class="metric-content">
                    <h3>{{ $region->created_at ? $region->created_at->format('d/m/Y') : '--/--/----' }}</h3>
                    <p>Ajoutée le</p>
                </div>
            </div>
        </div> -->

        <!-- Description de la région -->
        @if($region->description)
        <div class="region-description-section">
            <h2 class="section-title">
                <i class="fas fa-info-circle"></i>
                <span>À propos de la région</span>
            </h2>
            <div class="description-content">
                <p>{{ $region->description }}</p>
            </div>
        </div>
        @endif

        <!-- Contenus associés -->
        <div class="region-contents-section">
            <div class="section-header">
                <h2 class="section-title">
                    <i class="fas fa-book-open"></i>
                    <span>Contenus associés</span>
                </h2>
                <span class="contents-count">{{ $region->contenus_count ?? 0 }} contenus</span>
            </div>

            @if($region->contenus && $region->contenus->count() > 0)
            <div class="contents-grid">
                @foreach($region->contenus as $contenu)
                <div class="content-card-epure">
                    <div class="content-card-header">
                        <div class="content-type-icon">
                            @switch($contenu->id_type_contenu ?? 0)
                                @case(1)
                                    <i class="fas fa-utensils"></i>
                                    @break
                                @case(2)
                                    <i class="fas fa-book"></i>
                                    @break
                                @case(3)
                                    <i class="fas fa-newspaper"></i>
                                    @break
                                @default
                                    <i class="fas fa-file-alt"></i>
                            @endswitch
                        </div>
                        <div class="content-title-wrapper">
                            <h3>{{ $contenu->titre }}</h3>
                            @if($contenu->langue)
                            <span class="content-language">
                                <i class="fas fa-language"></i> {{ $contenu->langue->nom_langue }}
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="content-card-body">
                        @if($contenu->texte)
                        <p class="content-excerpt">
                            {{ Illuminate\Support\Str::limit(strip_tags($contenu->texte), 150) }}
                        </p>
                        @endif

                        <div class="content-meta">
                            @if($contenu->date_creation)
                            <span class="meta-item">
                                <i class="fas fa-calendar"></i>
                                {{ \Carbon\Carbon::parse($contenu->date_creation)->format('d/m/Y') }}
                            </span>
                            @endif
                            @if($contenu->auteur)
                            <span class="meta-item">
                                <i class="fas fa-user-edit"></i>
                                {{ $contenu->auteur->nom ?? '' }} {{ $contenu->auteur->prenom ?? '' }}
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="content-card-footer">
                        <a href="{{ route('contenus.show', $contenu->id_contenu) }}" class="view-content-btn">
                            <i class="fas fa-eye"></i>
                            <span>Voir le contenu</span>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="no-contents-message">
                <div class="empty-state">
                    <i class="fas fa-book fa-3x"></i>
                    <h3>Aucun contenu disponible</h3>
                    <p>Aucun contenu n'a encore été ajouté pour cette région.</p>
                </div>
            </div>
            @endif
        </div>

        <!-- Actions - seulement le bouton Retour -->
        <div class="region-actions">
            <a href="{{ route('regions.index') }}" class="action-btn back-btn">
                <i class="fas fa-arrow-left"></i>
                <span>Retour aux régions</span>
            </a>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
/* Variables */
:root {
    --primary-color: #2c3e50;
    --secondary-color: #3498db;
    --accent-color: #e74c3c;
    --success-color: #27ae60;
    --light-bg: #f8f9fa;
    --border-color: #e1e5eb;
    --text-color: #333;
    --text-light: #6c757d;
    --card-shadow: 0 2px 4px rgba(0,0,0,0.1);
    --hover-shadow: 0 4px 12px rgba(0,0,0,0.15);
    --radius: 10px;
    --transition: all 0.3s ease;
}

/* Layout */
.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 1rem;
}

.region-detail-section {
    padding: 2rem 0 4rem;
}

/* En-tête de la région */
.region-header-epure {
    background: white;
    border-radius: var(--radius);
    padding: 3rem 2rem;
    margin-bottom: 2rem;
    box-shadow: var(--card-shadow);
    display: flex;
    align-items: center;
    gap: 2rem;
    border-left: 5px solid var(--secondary-color);
}

.region-icon-large {
    width: 100px;
    height: 100px;
    background: linear-gradient(135deg, var(--secondary-color) 0%, #2980b9 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 2.5rem;
    flex-shrink: 0;
}

.region-header-content {
    flex: 1;
}

.region-header-content h1 {
    margin: 0 0 0.5rem 0;
    color: var(--primary-color);
    font-size: 2.5rem;
    font-weight: 700;
}

.region-location {
    margin: 0;
    color: var(--text-light);
    font-size: 1.1rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

/* Métriques */
.region-metrics-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1rem;
    margin-bottom: 2rem;
}

.metric-card {
    background: white;
    border-radius: var(--radius);
    padding: 1.5rem;
    box-shadow: var(--card-shadow);
    display: flex;
    align-items: center;
    gap: 1rem;
    transition: var(--transition);
    border-top: 3px solid var(--secondary-color);
}

.metric-card:hover {
    transform: translateY(-3px);
    box-shadow: var(--hover-shadow);
}

.metric-card:nth-child(2) {
    border-top-color: var(--success-color);
}

.metric-card:nth-child(3) {
    border-top-color: var(--accent-color);
}

.metric-card:nth-child(4) {
    border-top-color: var(--primary-color);
}

.metric-icon {
    width: 50px;
    height: 50px;
    background: var(--light-bg);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--secondary-color);
    font-size: 1.2rem;
}

.metric-card:nth-child(2) .metric-icon {
    color: var(--success-color);
}

.metric-card:nth-child(3) .metric-icon {
    color: var(--accent-color);
}

.metric-card:nth-child(4) .metric-icon {
    color: var(--primary-color);
}

.metric-content h3 {
    margin: 0 0 0.25rem 0;
    color: var(--primary-color);
    font-size: 1.5rem;
    font-weight: 600;
}

.metric-content p {
    margin: 0;
    color: var(--text-light);
    font-size: 0.9rem;
}

/* Description */
.region-description-section {
    background: white;
    border-radius: var(--radius);
    padding: 2rem;
    margin-bottom: 2rem;
    box-shadow: var(--card-shadow);
}

.section-title {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    color: var(--primary-color);
    font-size: 1.5rem;
    margin-bottom: 1.5rem;
    font-weight: 600;
}

.section-title i {
    color: var(--secondary-color);
}

.description-content {
    color: var(--text-color);
    line-height: 1.8;
    font-size: 1.05rem;
}

.description-content p {
    margin: 0;
}

/* Section des contenus */
.region-contents-section {
    background: white;
    border-radius: var(--radius);
    padding: 2rem;
    margin-bottom: 2rem;
    box-shadow: var(--card-shadow);
}

.section-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
}

.contents-count {
    background: var(--light-bg);
    color: var(--secondary-color);
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-weight: 500;
    font-size: 0.9rem;
}

/* Grille des contenus */
.contents-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
    gap: 1.5rem;
}

/* Carte de contenu */
.content-card-epure {
    background: var(--light-bg);
    border-radius: var(--radius);
    overflow: hidden;
    transition: var(--transition);
    border: 1px solid var(--border-color);
    display: flex;
    flex-direction: column;
}

.content-card-epure:hover {
    transform: translateY(-3px);
    box-shadow: var(--hover-shadow);
    border-color: var(--secondary-color);
}

.content-card-header {
    background: white;
    padding: 1.5rem;
    border-bottom: 1px solid var(--border-color);
    display: flex;
    align-items: center;
    gap: 1rem;
}

.content-type-icon {
    width: 45px;
    height: 45px;
    background: var(--secondary-color);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.1rem;
    flex-shrink: 0;
}

.content-title-wrapper {
    flex: 1;
}

.content-card-header h3 {
    margin: 0 0 0.25rem 0;
    color: var(--primary-color);
    font-size: 1.1rem;
    font-weight: 600;
    line-height: 1.4;
}

.content-language {
    font-size: 0.85rem;
    color: var(--text-light);
    display: flex;
    align-items: center;
    gap: 0.25rem;
}

.content-card-body {
    padding: 1.5rem;
    flex: 1;
}

.content-excerpt {
    color: var(--text-color);
    line-height: 1.6;
    font-size: 0.95rem;
    margin-bottom: 1rem;
}

.content-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 1rem;
    font-size: 0.85rem;
    color: var(--text-light);
}

.meta-item {
    display: flex;
    align-items: center;
    gap: 0.25rem;
}

.meta-item i {
    font-size: 0.8rem;
}

.content-card-footer {
    padding: 1rem 1.5rem;
    border-top: 1px solid var(--border-color);
    background: white;
}

.view-content-btn {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    background: var(--secondary-color);
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 6px;
    text-decoration: none;
    font-size: 0.9rem;
    font-weight: 500;
    transition: var(--transition);
}

.view-content-btn:hover {
    background: #2980b9;
    transform: translateY(-2px);
}

/* Aucun contenu */
.no-contents-message {
    text-align: center;
    padding: 3rem 2rem;
}

.empty-state {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 1rem;
}

.empty-state i {
    color: var(--text-light);
}

.empty-state h3 {
    color: var(--primary-color);
    margin: 0;
    font-size: 1.3rem;
}

.empty-state p {
    color: var(--text-light);
    margin: 0;
}

/* Actions - seulement le bouton Retour */
.region-actions {
    display: flex;
    justify-content: center;
    padding-top: 2rem;
    border-top: 1px solid var(--border-color);
}

.back-btn {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 500;
    font-size: 0.95rem;
    transition: var(--transition);
    background: white;
    color: var(--primary-color);
    border: 2px solid var(--border-color);
}

.back-btn:hover {
    background: var(--light-bg);
    border-color: var(--text-light);
}

/* Responsive */
@media (max-width: 768px) {
    .region-header-epure {
        flex-direction: column;
        text-align: center;
        padding: 2rem;
        gap: 1.5rem;
    }
    
    .region-metrics-grid {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .contents-grid {
        grid-template-columns: 1fr;
    }
    
    .section-header {
        flex-direction: column;
        gap: 1rem;
        align-items: flex-start;
    }
    
    .region-header-content h1 {
        font-size: 2rem;
    }
}

@media (max-width: 480px) {
    .region-metrics-grid {
        grid-template-columns: 1fr;
    }
    
    .metric-card {
        flex-direction: column;
        text-align: center;
        gap: 0.75rem;
    }
    
    .region-icon-large {
        width: 80px;
        height: 80px;
        font-size: 2rem;
    }
}
</style>
@endpush