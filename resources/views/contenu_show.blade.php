@extends('layouts.app')

@section('title', ($contenu->titre ?? 'Contenu') . ' - Patrimoine Bénin')

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

@push('styles')
<style>
/* ========== Variables ========== */
:root{
  --bg: #f7f9fb;
  --card: #ffffff;
  --muted: #6b7280;
  --text: #0f1724;
  --accent: #2563eb;
  --accent-2: #06b6d4;
  --success: #10b981;
  --danger: #ef4444;
  --border: #e6eef6;
  --shadow: 0 6px 20px rgba(15,23,36,0.06);
  --radius-sm: 8px;
  --radius: 12px;
  --container-w: 960px;
  --transition: 200ms cubic-bezier(.2,.9,.3,1);
  --max-width-narrow: 760px;
  --max-width-mobile: 540px;
}

/* ========== Reset / Base ========== */
* { box-sizing: border-box; }
html,body { height:100%; }
body{
  margin:0;
  font-family: Inter, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
  background: linear-gradient(180deg, var(--bg) 0%, #f3f6f9 100%);
  color:var(--text);
  -webkit-font-smoothing:antialiased;
  -moz-osx-font-smoothing:grayscale;
  line-height:1.6;
  font-size:16px;
}

/* ========== Layout container ========== */
.container{
  max-width:var(--container-w);
  margin:2.5rem auto;
  padding:0 1rem;
}

/* ========== Header block ========== */
.contenu-header-epure {
  display:flex;
  gap:1.5rem;
  align-items:center;
  background:var(--card);
  border-radius:var(--radius);
  padding:2rem;
  box-shadow:var(--shadow);
  border:1px solid var(--border);
  overflow:hidden;
}

.contenu-type-icon-large{
  min-width:84px;
  min-height:84px;
  display:flex;
  align-items:center;
  justify-content:center;
  border-radius:50%;
  background:linear-gradient(135deg,var(--accent), #1e40af);
  color:white;
  font-size:1.75rem;
  flex-shrink:0;
  box-shadow:0 6px 18px rgba(37,99,235,0.12);
}

.contenu-header-content { flex:1; }

/* region badge */
.region-badge{
  display:inline-flex;
  align-items:center;
  gap:.5rem;
  font-size:.9rem;
  color:var(--accent);
  background:rgba(37,99,235,0.06);
  padding:.35rem .7rem;
  border-radius:999px;
  text-decoration:none;
  border:1px solid rgba(37,99,235,0.06);
}

/* title & meta */
.contenu-header-content h1{
  margin:.4rem 0 0.6rem;
  font-size:1.9rem;
  font-weight:700;
  color:var(--text);
  letter-spacing:-0.01em;
}

.contenu-meta{
  display:flex;
  flex-wrap:wrap;
  gap: .6rem 1rem;
  align-items:center;
  color:var(--muted);
  font-size:0.95rem;
}

.meta-item{
  display:flex;
  align-items:center;
  gap:.5rem;
  background:transparent;
}

/* icons in meta */
.meta-item i{ color:var(--accent); font-size:0.95rem; }

/* ========== Alerts ========== */
.alert{
  border-radius:12px;
  border:1px solid var(--border);
  padding:1rem 1.25rem;
  display:flex;
  align-items:center;
  gap:.75rem;
  box-shadow:none;
}

.alert i{ font-size:1.05rem; color:var(--accent); }

.alert-success{ background: #ecfdf5; border-left:4px solid var(--success); color:var(--text); }
.alert-danger{ background:#fff5f5; border-left:4px solid var(--danger); color:var(--text); }
.alert-info{ background:#f0f7ff; border-left:4px solid var(--accent); color:var(--text); }

/* dismiss button */
.alert .close{
  margin-left:auto;
  background:transparent;
  border:none;
  font-size:1.1rem;
  color:var(--muted);
}

/* ========== Body card ========== */
.contenu-body-section{
  margin-top:1.75rem;
  background:var(--card);
  border-radius:var(--radius);
  padding:1.75rem;
  box-shadow:var(--shadow);
  border:1px solid var(--border);
}

/* text */
.contenu-text{
  color:var(--text);
  font-size:1rem;
  line-height:1.75;
}

.contenu-text p{ margin:0 0 1rem; color: #111827; }

/* full content block */
.full-content{
  margin-top:1rem;
  padding-top:1rem;
  border-top:1px dashed var(--border);
  white-space:pre-wrap;
}

/* access badge */
.access-badge{
  display:inline-flex;
  align-items:center;
  gap:.5rem;
  padding:.5rem .9rem;
  border-radius:8px;
  font-weight:600;
  margin-top:1rem;
  background:rgba(16,185,129,0.08);
  color:var(--success);
  border-left:3px solid var(--success);
}

/* ========== Payment CTA (cards) ========== */
.payment-cta{
  margin-top:1rem;
  background:linear-gradient(180deg,#ffffff,#fbfdff);
  border-radius:12px;
  padding:1.25rem;
  border:1px solid var(--border);
}

.payment-header h3{
  display:flex;
  gap:.5rem;
  align-items:center;
  margin:0 0 .35rem 0;
  font-size:1.15rem;
  color:var(--text);
}

.payment-header .text-muted{ color:var(--muted); margin:0 0 .8rem; font-size:.95rem; }

.payment-options{ display:grid; gap:1rem; grid-template-columns:1fr; }

.payment-option-card{
  background:transparent;
  border-radius:10px;
  padding:1rem;
  border:1px solid var(--border);
  transition:transform var(--transition), box-shadow var(--transition), border-color var(--transition);
}

.payment-option-card:hover{
  transform:translateY(-4px);
  border-color:rgba(37,99,235,0.12);
  box-shadow:0 8px 26px rgba(15,23,36,0.06);
}

/* price */
.option-price .price{
  font-size:1.3rem;
  font-weight:700;
  color:var(--text);
}

.option-price .price-note{ color:var(--muted); margin-left:.5rem; font-weight:500; font-size:.95rem; }

/* buttons */
.btn-pay-now{
  display:inline-flex;
  align-items:center;
  justify-content:center;
  gap:.6rem;
  width:100%;
  padding:.7rem .9rem;
  border-radius:10px;
  font-weight:700;
  color:#fff;
  text-decoration:none;
  border:none;
  background:linear-gradient(90deg,var(--accent), #1e3a8a);
  transition:transform var(--transition), box-shadow var(--transition);
}

.btn-pay-now:hover{ transform:translateY(-3px); box-shadow:0 10px 30px rgba(37,99,235,0.12); }

/* login button */
.btn-login{
  display:inline-flex;
  gap:.6rem;
  align-items:center;
  justify-content:center;
  padding:.6rem .9rem;
  border-radius:10px;
  background:transparent;
  color:var(--accent);
  border:1px solid rgba(37,99,235,0.08);
  text-decoration:none;
  font-weight:600;
}

/* small security footer */
.payment-security{
  margin-top:1rem;
  display:flex;
  gap:.5rem;
  align-items:center;
  justify-content:center;
  color:var(--muted);
  font-size:.94rem;
  padding-top:1rem;
  border-top:1px dashed var(--border);
}

/* ========== Info cards ========== */
.contenu-info-section{ margin-top:2rem; padding-top:1.5rem; border-top:1px solid var(--border); display:grid; gap:1rem; }

.info-card{
  padding:1rem;
  border-radius:10px;
  border:1px solid var(--border);
  background:transparent;
}

.info-card h3{ margin:0 0 .5rem; font-size:1rem; color:var(--text); display:flex; align-items:center; gap:.5rem; }
.info-card p{ margin:0; color:var(--muted); line-height:1.6; }

/* ========== Similaires / grid ========== */
.similaires-section{
  margin-top:1.5rem;
  background:transparent;
  padding:1rem;
  border-radius:10px;
}

.section-title{ display:flex; align-items:center; gap:.6rem; font-weight:700; color:var(--text); margin:0 0 .8rem; }

.similaires-grid{
  display:grid;
  gap:1rem;
  grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
}

.similaire-card{
  padding:1rem;
  border-radius:10px;
  border:1px solid var(--border);
  background:var(--card);
  transition:transform var(--transition), box-shadow var(--transition), border-color var(--transition);
}

.similaire-card:hover{ transform:translateY(-6px); box-shadow:var(--shadow); border-color:rgba(37,99,235,0.06); }

.similaire-type{ width:40px; height:40px; border-radius:50%; display:flex; align-items:center; justify-content:center; color:white; background:linear-gradient(135deg,var(--accent), #1e40af); margin-bottom:.7rem; }

/* ========== Actions ========== */
.contenu-actions{
  display:flex;
  gap:.6rem;
  justify-content:center;
  margin-top:1.5rem;
  padding-top:1rem;
  border-top:1px solid var(--border);
  flex-wrap:wrap;
}

.action-btn{
  display:inline-flex;
  align-items:center;
  gap:.6rem;
  padding:.6rem .9rem;
  border-radius:10px;
  font-weight:600;
  text-decoration:none;
  border:1px solid var(--border);
  background:var(--card);
  transition:transform var(--transition), box-shadow var(--transition);
}

.action-btn:hover{ transform:translateY(-3px); box-shadow:0 10px 22px rgba(2,6,23,0.04); }

.region-btn{ background:linear-gradient(90deg,var(--accent), #1e40af); color:white; border:none; }
.back-btn{ background:transparent; color:var(--text); }
.share-btn{ background:transparent; color:var(--text); }

/* ========== Modal styles (light) ========== */
.modal-content{ border-radius:12px; border:none; box-shadow:0 18px 40px rgba(2,6,23,0.12); }
.modal-header{ background:transparent; border-bottom:1px solid var(--border); padding:1rem 1.25rem; border-radius:12px 12px 0 0; }
.modal-title{ font-weight:700; color:var(--text); }
.modal-body{ padding:1rem 1.25rem; color:var(--muted); }
.modal-footer{ padding:1rem 1.25rem; border-top:1px solid var(--border); }

/* ========== Responsive tweaks ========== */
@media (max-width: 900px){
  .container{ margin:1.5rem auto; }
  .contenu-header-epure{ padding:1.25rem; gap:1rem; }
  .contenu-type-icon-large{ width:72px; height:72px; font-size:1.4rem; }
  .contenu-header-content h1{ font-size:1.4rem; }
}

@media (max-width: 560px){
  .contenu-header-epure{ flex-direction:column; text-align:center; align-items:center; padding:1rem; }
  .contenu-header-content h1{ font-size:1.15rem; }
  .similaires-grid{ grid-template-columns:1fr; }
  .contenu-actions{ flex-direction:column; gap:.5rem; }
  .payment-options{ grid-template-columns:1fr; }
  .container{ padding:0 0.75rem; }
}

/* ========== Accessibility helpers ========== */
a{ color:inherit; }
a:focus, button:focus{ outline:3px solid rgba(37,99,235,0.12); outline-offset:2px; border-radius:6px; }
.sr-only{ position:absolute; width:1px; height:1px; padding:0; margin:-1px; overflow:hidden; clip:rect(0 0 0 0); white-space:nowrap; border:0; }
</style>
@endpush

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