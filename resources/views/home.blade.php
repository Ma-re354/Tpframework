@extends('layouts.app')

@section('content')

{{-- HERO SECTION --}}
<section class="hero" id="accueil">
    <div class="video-background">
        <video autoplay muted loop id="bg-video">
            <source src="{{ asset('css/videoaccueil.mp4') }}" type="video/mp4">
        </video>
        <div class="video-overlay"></div>
    </div>
    <div class="container">
        <div class="hero-content">
            <h1>Patrimoine Culturel du Bénin</h1>
            <p>Découvrez, partagez et célébrez la richesse des traditions.</p>
            <div class="hero-buttons">
                <a href="/contenus" class="btn btn-primary">Explorer les contenus</a>
                <a href="/regions" class="btn btn-secondary">Découvrir les régions</a>
            </div>
        </div>
    </div>
</section>

<section class="quote-section">
    <div class="container">
        <div class="quote-content">
            <p class="quote-text">"Une culture qui ne se transmet pas est une culture qui meurt. Préservons ensemble notre héritage pour les générations futures."</p>
            <p class="quote-author">- Proverbe béninois</p>
        </div>
    </div>
</section>

<section class="features" id="contenus">
    <div class="container">
        <div class="section-title">
            <h2>Notre Mission Culturelle</h2>
        </div>
        <div class="features-grid">
            <div class="feature-card fade-in">
                <div class="feature-icon">
                    <i class="fas fa-book-open"></i>
                </div>
                <h3>Contenus Authentiques</h3>
                <p>Histoires, contes, recettes et articles documentant les traditions béninoises</p>
            </div>
            <div class="feature-card fade-in">
                <div class="feature-icon">
                    <i class="fas fa-language"></i>
                </div>
                <h3>Valorisation Linguistique</h3>
                <p>Contenus disponibles dans toutes les langues nationales du Bénin</p>
            </div>
            <div class="feature-card fade-in">
                <div class="feature-icon">
                    <i class="fas fa-users"></i>
                </div>
                <h3>Communauté Collaborative</h3>
                <p>Chaque béninois peut contribuer et enrichir notre patrimoine culturel</p>
            </div>
        </div>
    </div>
</section>

<!-- Content Types Section -->
<section class="content-types">
    <div class="container">
        <div class="section-title">
            <h2>Types de Contenus</h2>
            <p>Explorez la diversité des expressions culturelles béninoises</p>
        </div>
        <div class="types-grid">
            <div class="type-card fade-in">
                <div class="type-image" style="background-image: url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRYA3gMAipoQPMiy_W4xWPvutoG-1LE0YxXtw&s');"></div>
                <div class="type-content">
                    <h3>Histoires & Contes</h3>
                    <p>Récits traditionnels transmis oralement de génération en génération</p>
                    <a href="/contenus/histoires" class="type-link">Découvrir <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
            <div class="type-card fade-in">
                <div class="type-image" style="background-image: url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSWrd1FUcwsSghvigMrTySyqv7W2XPW090grw&s');"></div>
                <div class="type-content">
                    <h3>Recettes Culinaires</h3>
                    <p>Saveurs authentiques des plats traditionnels de toutes les régions</p>
                    <a href="/contenus/recettes" class="type-link">Explorer <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
            <div class="type-card fade-in">
                <div class="type-image" style="background-image: url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSRK4AO61xuMTlc1np82h8hwaXOiw8XDc-yBQ&s');"></div>
                <div class="type-content">
                    <h3>Articles Culturels</h3>
                    <p>Danses, rites, musiques et célébrations qui rythment la vie béninoise</p>
                    <a href="/contenus/articles" class="type-link">Lire <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
        <div class="text-center mt-4">
            <a href="/contenus" class="btn btn-outline">Voir tous les contenus</a>
        </div>
    </div>
</section>

<!-- Languages Section -->
<section class="languages" id="langues">
    <div class="container">
        <div class="section-title">
            <h2>Langues Nationales</h2>
            <p>Valoriser la riche diversité linguistique du Bénin</p>
        </div>
        <div class="languages-grid">
            <div class="language-item">
                <h4>Fon</h4>
                <p>Sud Bénin</p>
                
            </div>
            <div class="language-item">
                <h4>Yoruba</h4>
                <p>Sud-Est</p>
           
            </div>
            
            <div class="language-item">
                <h4>Dendi</h4>
                <p>Nord</p>
                
            </div>
            <div class="language-item">
                <h4>Goun</h4>
                <p>Sud</p>
                
            </div>
            <div class="language-item">
                <h4>Bariba</h4>
                <p>Nord-Est</p>
                
            </div>
            <div class="language-item">
                <h4>Adja</h4>
                <p>Sud-Ouest</p>
                
            </div>
        </div>
        <div class="text-center mt-4">
            <a href="/langues" class="btn btn-outline">Découvrir toutes les langues</a>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="stats">
    <div class="container">
        <div class="stats-container">
            <div class="stat-item">
                <h3>250+</h3>
                <p>Contenus Culturels</p>
            </div>
            <div class="stat-item">
                <h3>12</h3>
                <p>Langues Nationales</p>
            </div>
            <div class="stat-item">
                <h3>6</h3>
                <p>Régions Couvertes</p>
            </div>
            <div class="stat-item">
                <h3>1.2K</h3>
                <p>Contributeurs Actifs</p>
            </div>
        </div>
    </div>
</section>

<!-- Regions Section -->
<section class="regions" id="regions">
    <div class="container">
        <div class="section-title">
            <h2>Régions du Bénin</h2>
            <p>Découvrez la culture à travers la diversité géographique</p>
        </div>
        <div class="regions-container">
            <div class="regions-map floating">
                <h3>Carte Culturelle du Bénin</h3>
                <p>Explorez les traditions spécifiques à chaque région</p>
                <div class="mt-2">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/6d/Benin_Regions_map.png/600px-Benin_Regions_map.png" alt="Carte des régions du Bénin">
                </div>
            </div>
            <div class="regions-list">
                <div class="region-item">
                    <h4>Atacora</h4>
                    <p>Tata Somba, tissage, danses traditionnelles</p>
                    <a href="/regions/atacora" class="region-link">En savoir plus</a>
                </div>
                <div class="region-item">
                    <h4>Zou</h4>
                    <p>Histoire royale, artisanat, cérémonies vodoun</p>
                    <a href="/regions/zou" class="region-link">En savoir plus</a>
                </div>
                <div class="region-item">
                    <h4>Mono</h4>
                    <p>Pêche traditionnelle, tissage de paniers</p>
                    <a href="/regions/mono" class="region-link">En savoir plus</a>
                </div>
                <div class="region-item">
                    <h4>Collines</h4>
                    <p>Agriculture, musique, traditions orales</p>
                    <a href="/regions/collines" class="region-link">En savoir plus</a>
                </div>
                <div class="region-item">
                    <h4>Atlantique</h4>
                    <p>Culture côtière, pêche, danses Guèlèdè</p>
                    <a href="/regions/atlantique" class="region-link">En savoir plus</a>
                </div>
                <div class="region-item">
                    <h4>Borgou</h4>
                    <p>Élevage, fêtes traditionnelles, artisanat</p>
                    <a href="/regions/borgou" class="region-link">En savoir plus</a>
                </div>
            </div>
        </div>
        <div class="text-center mt-4">
            <a href="/regions" class="btn btn-outline">Explorer toutes les régions</a>
        </div>
    </div>
</section>
@endsection