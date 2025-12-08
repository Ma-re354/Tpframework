@extends('layouts.app')

@section('title', 'Langues du Bénin - Patrimoine Bénin')

@section('content')
<section class="page-header">
    <div class="container">
        <h1>Langues Nationales du Bénin</h1>
        <p>Découvrez la riche diversité linguistique de notre pays</p>
    </div>
</section>

<section class="languages-detail">
    <div class="container">
        @php
            $totalContenus = 0;
            if(isset($langues)) {
                foreach($langues as $langue) {
                    $totalContenus += $langue->contenus->count();
                }
            }
        @endphp
        
        <!-- <div class="languages-intro">
            <p>Le Bénin compte <strong>{{ $langues->count() ?? 0 }}</strong> langues nationales recensées, 
               avec <strong>{{ $totalContenus }}</strong> contenus culturels associés.</p>
        </div> -->
        
        <div class="languages-grid-detailed">
            @isset($langues)
                @if($langues->count() > 0)
                    @foreach($langues as $langue)
                    <div class="language-card-detailed">
                        <div class="language-header">
                            <div class="language-title-wrapper">
                                <h3>{{ $langue->nom_langue ?? 'Nom non disponible' }}</h3>
                                @if($langue->code_langue)
                                    <span class="code-badge">{{ $langue->code_langue }}</span>
                                @endif
                            </div>
                            <div class="language-stats">
                                <span class="content-count">
                                    <i class="fas fa-file-alt"></i>
                                    {{ $langue->contenus->count() }} contenus
                                </span>
                            </div>
                        </div>
                        
                        @if($langue->description)
                        <div class="language-description">
                            <p>{{ Illuminate\Support\Str::limit($langue->description, 200) }}</p>
                        </div>
                        @endif
                        
                        <div class="language-info">
                            <!-- <div class="info-item">
                                <strong><i class="fas fa-hashtag"></i> ID:</strong>
                                <span>#{{ $langue->id_langue }}</span>
                            </div> -->
                            
                            <!-- @if($langue->created_at)
                            <div class="info-item">
                                <strong><i class="fas fa-calendar-plus"></i> Ajoutée le:</strong>
                                <span>{{ $langue->created_at->format('d/m/Y') }}</span>
                            </div>
                            @endif -->
                        </div>
                        
                        <!-- Section des contenus associés -->
                        @if($langue->contenus && $langue->contenus->count() > 0)
                        <div class="related-contents">
                            <h4 class="related-title">
                                <i class="fas fa-book-open"></i>
                                Contenus associés
                            </h4>
                            
                            <div class="contents-mini-list">
                                @foreach($langue->contenus->take(3) as $contenu)
                                <div class="mini-content-card">
                                    <div class="mini-content-info">
                                        <h5>{{ Illuminate\Support\Str::limit($contenu->titre, 40) }}</h5>
                                        <div class="mini-content-meta">
                                            @if($contenu->region)
                                                <span class="mini-region">
                                                    <i class="fas fa-map-marker-alt"></i>
                                                    {{ $contenu->region->nom_region }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <a href="{{ route('contenus.show', $contenu->id_contenu) }}" class="mini-view-btn" title="Voir le contenu">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </div>
                                @endforeach
                            </div>
                            
                            @if($langue->contenus->count() > 3)
                            <div class="view-all-contents">
                                <a href="{{ route('contenus.index', ['langue' => $langue->id_langue]) }}" class="view-all-link">
                                    Voir les {{ $langue->contenus->count() }} contenus 
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                            @endif
                        </div>
                        @else
                        <div class="">
                            <p></p>
                         
                        </div>
                        @endif
                    </div>
                    @endforeach
                @else
                    <div class="no-data-message">
                        <div class="no-data-icon">
                            <i class="fas fa-language fa-3x"></i>
                        </div>
                        <p>Aucune langue n'est enregistrée dans la base de données pour le moment.</p>
                        @if(Route::has('admin.langues.create'))
                        <a href="{{ route('admin.langues.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Ajouter une langue
                        </a>
                        @endif
                    </div>
                @endif
            @else
                <div class="no-data-message">
                    <div class="no-data-icon">
                        <i class="fas fa-exclamation-triangle fa-3x"></i>
                    </div>
                    <p>Erreur: Impossible de charger les données des langues.</p>
                </div>
            @endisset
        </div>
        
        @isset($langues)
            @if($langues->count() > 0)
            <div class="languages-summary">
                <div class="summary-content">
                    <div class="summary-item">
                        <i class="fas fa-language"></i>
                        <div>
                            <h4>{{ $langues->count() }}</h4>
                            <p>Langues recensées</p>
                        </div>
                    </div>
                    <div class="summary-item">
                        <i class="fas fa-file-alt"></i>
                        <div>
                            <h4>{{ $totalContenus }}</h4>
                            <p>Contenus culturels</p>
                        </div>
                    </div>
                    <div class="summary-item">
                        <i class="fas fa-calendar-alt"></i>
                        <div>
                            <h4>{{ $langues->max('created_at') ? \Carbon\Carbon::parse($langues->max('created_at'))->format('d/m/Y') : '--/--/----' }}</h4>
                            <p>Dernière mise à jour</p>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        @endisset
    </div>
</section>

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
    --shadow: 0 4px 15px rgba(0,0,0,0.08);
    --radius: 12px;
    --transition: all 0.3s ease;
}

/* Container principal */
.languages-detail .container {
    max-width: 1200px;
}

/* Introduction */
.languages-intro {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 1.5rem 2rem;
    border-radius: var(--radius);
    margin-bottom: 2rem;
    text-align: center;
    box-shadow: var(--shadow);
}

.languages-intro p {
    margin: 0;
    font-size: 1.1rem;
}

.languages-intro strong {
    font-weight: 700;
    color: white;
}

/* Grille des langues */
.languages-grid-detailed {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(380px, 1fr));
    gap: 2rem;
    margin-bottom: 3rem;
}

/* Carte de langue */
.language-card-detailed {
    background: white;
    border-radius: var(--radius);
    overflow: hidden;
    box-shadow: var(--shadow);
    transition: var(--transition);
    padding: 1.5rem;
    border: 1px solid var(--border-color);
    display: flex;
    flex-direction: column;
    height: 100%;
}

.language-card-detailed:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.12);
    border-color: var(--secondary-color);
}

/* En-tête de la carte */
.language-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 1rem;
    padding-bottom: 1rem;
    border-bottom: 2px solid var(--light-bg);
}

.language-title-wrapper {
    flex: 1;
}

.language-header h3 {
    margin: 0 0 0.5rem 0;
    color: var(--primary-color);
    font-size: 1.4rem;
    font-weight: 700;
}

.code-badge {
    background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    color: white;
    padding: 0.25rem 0.75rem;
    border-radius: 15px;
    font-size: 0.8rem;
    font-weight: 600;
    letter-spacing: 0.5px;
    display: inline-block;
}

.language-stats {
    text-align: right;
}

.content-count {
    background: var(--light-bg);
    color: var(--secondary-color);
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.content-count i {
    font-size: 0.9rem;
}

/* Description */
.language-description {
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    padding: 1.25rem;
    border-radius: 10px;
    margin: 1rem 0;
    border-left: 4px solid var(--secondary-color);
}

.language-description p {
    margin: 0;
    color: var(--text-color);
    line-height: 1.6;
    font-size: 0.95rem;
}

/* Informations */
.language-info {
    display: flex;
    gap: 1.5rem;
    margin: 1.5rem 0;
    padding-top: 1rem;
    border-top: 1px solid var(--border-color);
    flex-wrap: wrap;
}

.info-item {
    display: flex;
    flex-direction: column;
    min-width: 120px;
}

.info-item strong {
    color: var(--text-light);
    font-size: 0.85rem;
    margin-bottom: 0.25rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.info-item span {
    color: var(--primary-color);
    font-weight: 500;
    font-size: 0.95rem;
}

/* Contenus associés */
.related-contents {
    margin-top: 1.5rem;
    padding-top: 1.5rem;
    border-top: 1px solid var(--border-color);
}

.related-title {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    color: var(--primary-color);
    font-size: 1.1rem;
    margin-bottom: 1rem;
    font-weight: 600;
}

.related-title i {
    color: var(--secondary-color);
}

.contents-mini-list {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
    margin-bottom: 1rem;
}

.mini-content-card {
    background: var(--light-bg);
    border-radius: 8px;
    padding: 0.75rem 1rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    transition: var(--transition);
    border: 1px solid transparent;
}

.mini-content-card:hover {
    background: white;
    border-color: var(--secondary-color);
    transform: translateX(5px);
}

.mini-content-info {
    flex: 1;
}

.mini-content-card h5 {
    margin: 0 0 0.5rem 0;
    color: var(--primary-color);
    font-size: 0.95rem;
    font-weight: 600;
    line-height: 1.3;
}

.mini-content-meta {
    display: flex;
    gap: 1rem;
    font-size: 0.8rem;
}

.mini-region, .mini-date {
    display: inline-flex;
    align-items: center;
    gap: 0.25rem;
    color: var(--text-light);
}

.mini-region i {
    color: var(--secondary-color);
    font-size: 0.7rem;
}

.mini-view-btn {
    width: 32px;
    height: 32px;
    background: var(--secondary-color);
    color: white;
    border: none;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: var(--transition);
    text-decoration: none;
}

.mini-view-btn:hover {
    background: var(--primary-color);
    transform: scale(1.1);
}

/* Voir tous les contenus */
.view-all-contents {
    text-align: center;
    padding-top: 0.5rem;
}

.view-all-link {
    color: var(--secondary-color);
    text-decoration: none;
    font-weight: 500;
    font-size: 0.9rem;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    transition: var(--transition);
}

.view-all-link:hover {
    color: var(--primary-color);
    gap: 0.75rem;
}

.view-all-link i {
    font-size: 0.8rem;
}

/* Message pas de contenus */
.no-contents-message {
    background: #fff9e6;
    border: 1px solid #ffeaa7;
    border-radius: 8px;
    padding: 1rem;
    text-align: center;
    margin-top: 1.5rem;
}

.no-contents-message p {
    margin: 0;
    color: #e67e22;
    font-size: 0.9rem;
}

/* Message pas de données */
.no-data-message {
    grid-column: 1 / -1;
    text-align: center;
    padding: 4rem 2rem;
    background: white;
    border-radius: var(--radius);
    box-shadow: var(--shadow);
}

.no-data-icon {
    margin-bottom: 1.5rem;
    color: var(--text-light);
}

.no-data-message p {
    color: var(--text-light);
    font-size: 1.1rem;
    margin-bottom: 1.5rem;
}

/* Résumé */
.languages-summary {
    background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
    color: white;
    border-radius: var(--radius);
    padding: 2rem;
    box-shadow: var(--shadow);
}

.summary-content {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 2rem;
    text-align: center;
}

.summary-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 1rem;
}

.summary-item i {
    font-size: 2.5rem;
    color: rgba(255, 255, 255, 0.9);
    margin-bottom: 0.5rem;
}

.summary-item h4 {
    font-size: 2rem;
    font-weight: 700;
    margin: 0;
    color: white;
}

.summary-item p {
    margin: 0;
    font-size: 0.95rem;
    color: rgba(255, 255, 255, 0.8);
}

/* Responsive */
@media (max-width: 768px) {
    .languages-grid-detailed {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }
    
    .language-header {
        flex-direction: column;
        gap: 1rem;
    }
    
    .language-stats {
        align-self: flex-start;
    }
    
    .language-info {
        flex-direction: column;
        gap: 1rem;
    }
    
    .summary-content {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }
}

@media (max-width: 480px) {
    .language-card-detailed {
        padding: 1rem;
    }
    
    .languages-intro {
        padding: 1rem;
    }
    
    .languages-summary {
        padding: 1.5rem 1rem;
    }
}
</style>
@endsection