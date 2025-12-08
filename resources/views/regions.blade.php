@extends('layouts.app')

@section('title', 'Régions du Bénin - Patrimoine Bénin')

@section('content')
<section class="page-header">
    <div class="container">
        <h1>Régions du Bénin</h1>
        <p>Découvrez la diversité culturelle à travers la géographie du pays</p>
        <p class="regions-count">{{ $regions->count() }} régions à découvrir</p>
    </div>
</section>

<section class="regions-overview">
    <div class="container">
        @if($regions->count() > 0)
            <div class="regions-grid-detailed">
                @foreach($regions as $region)
                    <div class="region-card-detailed">
                        <!-- En-tête de la région sans image -->
                        <div class="region-header-no-image">
                            <div class="region-icon-container">
                                <!-- <div class="region-icon">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div> -->
                                <div class="region-title-info">
                                    <h3>{{ $region->nom_region }}</h3>
                                    @if($region->localisation)
                                        <p class="region-location-info">
                                            <i class="fas fa-compass"></i> {{ $region->localisation }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <div class="region-content">
                            <div class="region-stats">
                                @if($region->population)
                                    <div class="stat">
                                        <div class="stat-icon-small">
                                            <i class="fas fa-users"></i>
                                        </div>
                                        <div class="stat-info">
                                            <strong>{{ number_format($region->population, 0, ',', ' ') }}</strong>
                                            <span>Habitants</span>
                                        </div>
                                    </div>
                                @endif
                                
                                @if($region->superficie)
                                    <div class="stat">
                                        <div class="stat-icon-small">
                                            <i class="fas fa-mountain"></i>
                                        </div>
                                        <div class="stat-info">
                                            <strong>{{ number_format($region->superficie, 0, ',', ' ') }}</strong>
                                            <span>km²</span>
                                        </div>
                                    </div>
                                @endif
                                
                                <div class="stat">
                                    <div class="stat-icon-small">
                                        <i class="fas fa-book"></i>
                                    </div>
                                    <div class="stat-info">
                                        <strong>{{ $region->contenus_count ?? 0 }}</strong>
                                        <span>Contenus</span>
                                    </div>
                                </div>
                            </div>
                            
                            @if($region->description)
                                <div class="region-details">
                                    <h4><i class="fas fa-info-circle"></i> À propos</h4>
                                    <p>{{ Str::limit($region->description, 120) }}</p>
                                    @if(strlen($region->description) > 120)
                                        <a href="{{ route('regions.show', $region->id_region) }}" class="read-more">
                                            Lire la suite <i class="fas fa-arrow-right"></i>
                                        </a>
                                    @endif
                                </div>
                            @endif
                            
                            <div class="region-actions">
                                <a href="{{ route('regions.show', $region->id_region) }}" class="btn btn-primary">
                                    <i class="fas fa-eye"></i> Découvrir
                                </a>
                                <a href="{{ route('contenus.index') }}?region={{ $region->id_region }}" class="btn btn-outline">
                                    <i class="fas fa-book-open"></i> Contenus
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="no-regions">
                <div class="text-center py-5">
                    <i class="fas fa-map fa-3x text-muted mb-3"></i>
                    <h3>Aucune région disponible</h3>
                    <p class="text-muted">Les régions n'ont pas encore été ajoutées.</p>
                    @if(auth()->check() && auth()->user()->id_role == 1) <!-- Admin seulement -->
                        <a href="{{ route('admin.regions.create') }}" class="btn btn-primary mt-3">
                            <i class="fas fa-plus"></i> Ajouter une région
                        </a>
                    @endif
                </div>
            </div>
        @endif
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
    --light-bg: #f8f9fa;
    --border-color: #e1e5eb;
    --text-color: #333;
    --text-light: #6c757d;
    --shadow: 0 4px 15px rgba(0,0,0,0.08);
    --radius: 12px;
    --transition: all 0.3s ease;
}

/* Container */
.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 1rem;
}

/* En-tête */
.page-header {
    background: linear-gradient(135deg, var(--primary-color) 0%, #1a2530 100%);
    color: white;
    padding: 3rem 0;
    text-align: center;
    margin-bottom: 2rem;
}

.page-header h1 {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
}

.page-header p {
    font-size: 1.1rem;
    opacity: 0.9;
    margin-bottom: 0.5rem;
}

.regions-count {
    background: rgba(255, 255, 255, 0.1);
    display: inline-block;
    padding: 0.5rem 1.5rem;
    border-radius: 20px;
    font-weight: 500;
    margin-top: 1rem;
    font-size: 1rem;
}

/* Grille des régions */
.regions-grid-detailed {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
    gap: 2rem;
}

/* Carte de région sans image */
.region-card-detailed {
    background: white;
    border-radius: var(--radius);
    overflow: hidden;
    box-shadow: var(--shadow);
    transition: var(--transition);
    border: 1px solid var(--border-color);
    height: 100%;
    display: flex;
    flex-direction: column;
}

.region-card-detailed:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.12);
    border-color: var(--secondary-color);
}

/* En-tête sans image */
.region-header-no-image {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 2rem 1.5rem;
    position: relative;
}

.region-icon-container {
    display: flex;
    align-items: center;
    gap: 1.5rem;
}

.region-icon {
    width: 70px;
    height: 70px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.8rem;
    color: white;
    border: 3px solid rgba(255, 255, 255, 0.3);
    flex-shrink: 0;
}

.region-title-info {
    flex: 1;
}

.region-header-no-image h3 {
    margin: 0 0 0.5rem 0;
    font-size: 1.8rem;
    font-weight: 700;
    color: white;
}

.region-location-info {
    margin: 0;
    opacity: 0.9;
    font-size: 1rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.region-location-info i {
    font-size: 0.9rem;
}

/* Contenu de la région */
.region-content {
    padding: 1.5rem;
    flex: 1;
    display: flex;
    flex-direction: column;
}

/* Statistiques */
.region-stats {
    display: flex;
    justify-content: space-around;
    margin-bottom: 1.5rem;
    padding-bottom: 1.5rem;
    border-bottom: 1px solid var(--border-color);
}

.region-stats .stat {
    text-align: center;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.75rem;
    min-width: 90px;
}

.stat-icon-small {
    width: 50px;
    height: 50px;
    background: var(--secondary-color);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.2rem;
}

.region-stats .stat:nth-child(2) .stat-icon-small {
    background: var(--success-color);
}

.region-stats .stat:nth-child(3) .stat-icon-small {
    background: var(--accent-color);
}

.region-stats .stat-info {
    text-align: center;
}

.region-stats .stat-info strong {
    display: block;
    font-size: 1.4rem;
    color: var(--primary-color);
    font-weight: 700;
    line-height: 1.2;
}

.region-stats .stat-info span {
    font-size: 0.85rem;
    color: var(--text-light);
    display: block;
    margin-top: 3px;
}

/* Détails */
.region-details {
    margin-bottom: 1.5rem;
    flex: 1;
}

.region-details h4 {
    color: var(--primary-color);
    margin-bottom: 0.75rem;
    font-size: 1.1rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.region-details p {
    color: var(--text-color);
    line-height: 1.6;
    font-size: 0.95rem;
    margin-bottom: 0.75rem;
}

.read-more {
    color: var(--secondary-color);
    text-decoration: none;
    font-size: 0.9rem;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    transition: gap 0.3s;
    font-weight: 500;
}

.read-more:hover {
    gap: 0.75rem;
    color: #2980b9;
}

/* Actions */
.region-actions {
    display: flex;
    gap: 0.75rem;
    margin-top: auto;
}

.region-actions .btn {
    flex: 1;
    text-align: center;
    padding: 0.75rem 1rem;
    text-decoration: none;
    border-radius: 8px;
    font-weight: 500;
    transition: all 0.3s;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    font-size: 0.95rem;
    border: 2px solid transparent;
}

.btn-primary {
    background: var(--secondary-color);
    color: white;
    border-color: var(--secondary-color);
}

.btn-primary:hover {
    background: #2980b9;
    border-color: #2980b9;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(41, 128, 185, 0.3);
}

.btn-outline {
    background: transparent;
    color: var(--secondary-color);
    border-color: var(--secondary-color);
}

.btn-outline:hover {
    background: var(--secondary-color);
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(52, 152, 219, 0.3);
}

/* Aucune région */
.no-regions {
    text-align: center;
    padding: 4rem 2rem;
    background: var(--light-bg);
    border-radius: var(--radius);
    margin-top: 2rem;
}

.no-regions .fa-map {
    color: #a0aec0;
}

.no-regions h3 {
    color: var(--primary-color);
    margin-bottom: 0.75rem;
    font-size: 1.5rem;
}

.no-regions .text-muted {
    color: var(--text-light);
    margin-bottom: 1.5rem;
}

/* Responsive */
@media (max-width: 768px) {
    .regions-grid-detailed {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }
    
    .region-stats {
        flex-direction: column;
        gap: 1.5rem;
        align-items: center;
    }
    
    .region-stats .stat {
        flex-direction: row;
        text-align: left;
        gap: 1rem;
        width: 100%;
        max-width: 250px;
        justify-content: flex-start;
    }
    
    .region-actions {
        flex-direction: column;
    }
    
    .region-header-no-image {
        padding: 1.5rem;
    }
    
    .region-icon-container {
        flex-direction: column;
        text-align: center;
        gap: 1rem;
    }
    
    .region-title-info {
        text-align: center;
    }
    
    .region-location-info {
        justify-content: center;
    }
    
    .page-header {
        padding: 2rem 1rem;
    }
    
    .page-header h1 {
        font-size: 2rem;
    }
}

@media (max-width: 480px) {
    .region-header-no-image h3 {
        font-size: 1.5rem;
    }
    
    .region-icon {
        width: 60px;
        height: 60px;
        font-size: 1.5rem;
    }
    
    .region-content {
        padding: 1.25rem;
    }
    
    .stat-icon-small {
        width: 45px;
        height: 45px;
        font-size: 1.1rem;
    }
    
    .region-stats .stat-info strong {
        font-size: 1.3rem;
    }
}
</style>
@endpush