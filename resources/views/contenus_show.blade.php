@extends('layouts.app')

@section('title', ($contenu->titre ?? 'Contenu') . ' - Patrimoine Bénin')

{{-- Chargez le fichier CSS externe --}}
@push('styles')
<link rel="stylesheet" href="{{ asset('css/contenus-show.css') }}">
@endpush

@section('content')
<section class="contenu-detail-section">
    <div class="container">
        <!-- En-tête du contenu -->
        <div class="contenu-header-epure">
            <div class="contenu-type-icon-large">
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
            <div class="contenu-header-content">
                <div class="contenu-header-top">
                    @if(isset($region) && $region->nom_region && $region->nom_region != 'Sans région')
                    <a href="{{ $region->id_region ? route('regions.show', $region->id_region) : '#' }}" class="region-badge">
                        <i class="fas fa-map-marker-alt"></i>
                        {{ $region->nom_region }}
                    </a>
                    @endif
                </div>
                <h1>{{ $contenu->titre ?? 'Titre non disponible' }}</h1>
                
                <div class="contenu-meta">
                    @if($contenu->auteur ?? false)
                    <span class="meta-item">
                        <i class="fas fa-user-edit"></i>
                        {{ $contenu->auteur->nom ?? '' }} {{ $contenu->auteur->prenom ?? '' }}
                    </span>
                    @endif
                    
                    @if($contenu->date_creation ?? false)
                    <span class="meta-item">
                        <i class="fas fa-calendar"></i>
                        {{ \Carbon\Carbon::parse($contenu->date_creation)->format('d/m/Y') }}
                    </span>
                    @endif
                    
                    @if($contenu->langue ?? false)
                    <span class="meta-item">
                        <i class="fas fa-language"></i>
                        {{ $contenu->langue->nom_langue ?? '' }}
                    </span>
                    @endif
                    
                    @if($contenu->typeContenu ?? false)
                    <span class="meta-item">
                        <i class="fas fa-tag"></i>
                        {{ $contenu->typeContenu->nom_type_contenu ?? '' }}
                    </span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Messages d'alerte -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle"></i>
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-triangle"></i>
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <!-- Contenu principal -->
        <div class="contenu-body-section">
            @if($contenu->texte ?? false)
                @php
                    $maxWords = 50; // Nombre de mots avant troncature
                    $text = strip_tags($contenu->texte);
                    $words = str_word_count($text, 1);
                    $isTruncated = count($words) > $maxWords;
                    $excerpt = implode(' ', array_slice($words, 0, $maxWords));
                @endphp

                <div class="contenu-text">
                    <p>{{ $excerpt }}{{ $isTruncated ? '...' : '' }}</p>
                    
                    @if($isTruncated)
                        @auth
                            @if($hasPaid ?? false)
                                <!-- Afficher le contenu complet si l'utilisateur a payé -->
                                <div class="full-content mt-4">
                                    {!! nl2br(e($contenu->texte)) !!}
                                </div>
                                
                                <div class="access-badge paid-access">
                                    <i class="fas fa-unlock-alt"></i>
                                    Accès complet - Vous avez payé pour ce contenu
                                </div>
                            @else
                                <!-- Bouton pour payer et lire la suite -->
                                <div class="payment-cta mt-4">
                                    <div class="payment-header">
                                        <h3>
                                            <i class="fas fa-lock"></i>
                                            Contenu restreint
                                        </h3>
                                        <p class="text-muted">
                                            {{ count($words) - $maxWords }} mots supplémentaires disponibles après paiement
                                        </p>
                                    </div>
                                    
                                    <div class="payment-options">
                                        <div class="payment-option-card">
                                            <div class="option-header">
                                                <i class="fas fa-unlock-alt"></i>
                                                <h4>Accès complet</h4>
                                            </div>
                                            <div class="option-price">
                                                <span class="price">500 XOF</span>
                                                <span class="price-note">(~0.75€)</span>
                                            </div>
                                            <p class="option-description">
                                                Accès permanent à tout le contenu
                                            </p>
                                            <a href="{{ route('payment.content', $contenu->id_contenu) }}" 
                                               class="btn btn-pay-now">
                                                <i class="fas fa-credit-card"></i>
                                                Débloquer maintenant
                                            </a>
                                        </div>
                                    </div>
                                    
                                    <div class="payment-security">
                                        <i class="fas fa-shield-alt"></i>
                                        <span>Paiement 100% sécurisé par FedaPay</span>
                                    </div>
                                </div>
                            @endif
                        @else
                            <!-- Inviter à se connecter pour payer -->
                            <div class="payment-cta mt-4">
                                <div class="payment-header">
                                    <h3>
                                        <i class="fas fa-lock"></i>
                                        Accès restreint
                                    </h3>
                                    <p class="text-muted">
                                        Connectez-vous pour accéder au contenu complet
                                    </p>
                                </div>
                                
                                <div class="auth-options">
                                    <a href="{{ route('login') }}" class="btn btn-login">
                                        <i class="fas fa-sign-in-alt"></i>
                                        Se connecter
                                    </a>
                                    <p class="auth-note">
                                        Pas encore de compte ? 
                                        <a href="{{ route('register') }}">S'inscrire gratuitement</a>
                                    </p>
                                </div>
                            </div>
                        @endauth
                    @else
                        <!-- Si le contenu n'est pas tronqué, tout afficher -->
                        <div class="full-content mt-4">
                            {!! nl2br(e($contenu->texte)) !!}
                        </div>
                    @endif
                </div>
            @else
                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i>
                    Aucun texte disponible pour ce contenu.
                </div>
            @endif
            
            <!-- Informations supplémentaires -->
            @if(($contenu->description ?? false) || ($contenu->sources ?? false))
            <div class="contenu-info-section">
                @if($contenu->description)
                <div class="info-card">
                    <h3><i class="fas fa-info-circle"></i> Description</h3>
                    <p>{{ $contenu->description }}</p>
                </div>
                @endif
                
                @if($contenu->sources)
                <div class="info-card">
                    <h3><i class="fas fa-link"></i> Sources</h3>
                    <p>{{ $contenu->sources }}</p>
                </div>
                @endif
            </div>
            @endif
        </div>

        <!-- Contenus similaires -->
        @if($contenusSimilaires && $contenusSimilaires->count() > 0)
        <div class="similaires-section">
            <h2 class="section-title">
                <i class="fas fa-book-open"></i>
                <span>Contenus similaires</span>
            </h2>
            
            <div class="similaires-grid">
                @foreach($contenusSimilaires as $similaire)
                <div class="similaire-card">
                    <div class="similaire-type">
                        @switch($similaire->id_type_contenu ?? 0)
                            @case(1) <i class="fas fa-utensils"></i> @break
                            @case(2) <i class="fas fa-book"></i> @break
                            @case(3) <i class="fas fa-newspaper"></i> @break
                            @default <i class="fas fa-file-alt"></i>
                        @endswitch
                    </div>
                    <h4>{{ $similaire->titre }}</h4>
                    <p class="similaire-excerpt">
                        {{ Illuminate\Support\Str::limit(strip_tags($similaire->texte ?? ''), 100) }}
                    </p>
                    <a href="{{ route('contenus.show', $similaire->id_contenu) }}" class="btn-view-similaire">
                        Voir ce contenu
                    </a>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Actions -->
        <div class="contenu-actions">
            <a href="javascript:history.back()" class="action-btn back-btn">
                <i class="fas fa-arrow-left"></i>
                <span>Retour</span>
            </a>
            
            @if(isset($region) && $region->id_region)
            <a href="{{ route('regions.show', $region->id_region) }}" class="action-btn region-btn">
                <i class="fas fa-map-marker-alt"></i>
                <span>Voir la région</span>
            </a>
            @endif
            
            @if(isset($contenu) && $contenu->id_contenu)
            <!-- Optionnel : Bouton de partage -->
            <button class="action-btn share-btn" onclick="shareContent()">
                <i class="fas fa-share-alt"></i>
                <span>Partager</span>
            </button>
            @endif
        </div>
    </div>
</section>

<!-- Modal de confirmation de paiement -->
@if(isset($contenu) && $contenu->id_contenu)
<div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-unlock-alt"></i> Débloquer le contenu
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Vous êtes sur le point d'acheter l'accès complet à ce contenu.</p>
                <div class="payment-details">
                    <div class="detail-item">
                        <span class="detail-label">Contenu :</span>
                        <span class="detail-value">{{ $contenu->titre }}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Prix :</span>
                        <span class="detail-value">500 XOF</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Méthode :</span>
                        <span class="detail-value">
                            <i class="fas fa-credit-card"></i> Carte bancaire
                        </span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Sécurité :</span>
                        <span class="detail-value text-success">
                            <i class="fas fa-shield-alt"></i> 100% sécurisé
                        </span>
                    </div>
                </div>
                <div class="alert alert-info mt-3">
                    <i class="fas fa-info-circle"></i>
                    Vous aurez un accès permanent à ce contenu après paiement.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times"></i> Annuler
                </button>
                <a href="#" class="btn btn-success" id="confirmPaymentBtn">
                    <i class="fas fa-check"></i> Confirmer et payer
                </a>
            </div>
        </div>
    </div>
</div>
@endif
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Gestion du modal de paiement
    const paymentModal = document.getElementById('paymentModal');
    const confirmPaymentBtn = document.getElementById('confirmPaymentBtn');
    
    // Ouvrir le modal quand on clique sur un bouton de paiement
    document.querySelectorAll('.btn-pay-now').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const paymentUrl = this.getAttribute('href');
            
            // Stocker l'URL de paiement dans le bouton de confirmation
            if (confirmPaymentBtn) {
                confirmPaymentBtn.setAttribute('href', paymentUrl);
                
                // Afficher le modal
                if (paymentModal) {
                    $(paymentModal).modal('show');
                }
            } else {
                // Rediriger directement si pas de modal
                window.location.href = paymentUrl;
            }
        });
    });
    
    // Rediriger vers FedaPay quand on confirme le paiement
    if (confirmPaymentBtn) {
        confirmPaymentBtn.addEventListener('click', function(e) {
            e.preventDefault();
            const paymentUrl = this.getAttribute('href');
            
            // Fermer le modal
            if (paymentModal) {
                $(paymentModal).modal('hide');
            }
            
            // Rediriger vers la page de paiement
            window.location.href = paymentUrl;
        });
    }
});

function shareContent() {
    if (navigator.share) {
        navigator.share({
            title: '{{ $contenu->titre ?? "Contenu" }}',
            text: 'Découvrez ce contenu sur Patrimoine Bénin',
            url: window.location.href,
        })
        .then(() => console.log('Contenu partagé avec succès'))
        .catch((error) => console.log('Erreur de partage:', error));
    } else {
        // Fallback pour les navigateurs qui ne supportent pas l'API Web Share
        navigator.clipboard.writeText(window.location.href)
            .then(() => {
                alert('Lien copié dans le presse-papier !');
            })
            .catch(err => {
                console.error('Erreur de copie:', err);
            });
    }
}
</script>
@endpush