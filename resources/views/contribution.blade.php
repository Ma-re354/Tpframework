@extends('layouts.app')

@section('title', 'Contribuer - Patrimoine Bénin')

@section('content')
<section class="contribution-section">
    <div class="container">
        <div class="contribution-header">
            <h1>Contribuer au patrimoine</h1>
            <p>Partagez vos connaissances et enrichissez notre base de données culturelle</p>
        </div>

        <!-- Étape 1: Authentification -->
        <div class="auth-step" id="authStep">
            <div class="step-header">
                <div class="step-number">1</div>
                <div class="step-title">
                    <h2>Authentification</h2>
                    <p>Connectez-vous ou créez un compte pour contribuer</p>
                </div>
            </div>

            <div class="auth-options">
                <!-- Formulaire de connexion -->
                <div class="auth-form-container" id="loginFormContainer">
                    <h3>Déjà inscrit ?</h3>
                    <form id="loginForm" class="auth-form">
                        @csrf
                        <div class="form-group">
                            <label for="login_email">Email</label>
                            <input type="email" id="login_email" name="email" required 
                                   placeholder="votre@email.com">
                        </div>
                        <div class="form-group">
                            <label for="login_password">Mot de passe</label>
                            <input type="password" id="login_password" name="mot_de_passe" required 
                                   placeholder="Votre mot de passe">
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">
                            <i class="fas fa-sign-in-alt"></i> Se connecter
                        </button>
                    </form>
                </div>

                <div class="auth-divider">
                    <span>OU</span>
                </div>

                <!-- Formulaire d'inscription -->
                <div class="auth-form-container" id="registerFormContainer">
                    <h3>Nouveau contributeur ?</h3>
                    <form id="registerForm" class="auth-form">
                        @csrf
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="nom">Nom *</label>
                                <input type="text" id="nom" name="nom" required 
                                       placeholder="Votre nom de famille">
                            </div>
                            <div class="form-group">
                                <label for="prenom">Prénom *</label>
                                <input type="text" id="prenom" name="prenom" required 
                                       placeholder="Votre prénom">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email">Email *</label>
                            <input type="email" id="email" name="email" required 
                                   placeholder="votre@email.com">
                        </div>

                        <div class="form-group">
                            <label for="mot_de_passe">Mot de passe *</label>
                            <input type="password" id="mot_de_passe" name="mot_de_passe" required 
                                   placeholder="Créez un mot de passe sécurisé">
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="sexe">Sexe</label>
                                <select id="sexe" name="sexe" class="form-control">
                                    <option value="">Sélectionnez</option>
                                    <option value="M">Masculin</option>
                                    <option value="F">Féminin</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="date_naissance">Date de naissance</label>
                                <input type="date" id="date_naissance" name="date_naissance">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="id_langue">Langue préférée</label>
                            <select id="id_langue" name="id_langue" class="form-control">
                                <option value="">Sélectionnez une langue</option>
                                @foreach($langues as $langue)
                                    <option value="{{ $langue->id_langue }}">{{ $langue->nom_langue }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="photo">Photo de profil (optionnel)</label>
                            <input type="file" id="photo" name="photo" accept="image/*" 
                                   class="form-control-file">
                            <small class="text-muted">Format: JPG, PNG - Max: 2MB</small>
                        </div>

                        <div class="form-check">
                            <input type="checkbox" id="terms" name="terms" required 
                                   class="form-check-input">
                            <label for="terms" class="form-check-label">
                                J'accepte les <a href="#">conditions d'utilisation</a> et la 
                                <a href="#">politique de confidentialité</a>
                            </label>
                        </div>

                        <button type="submit" class="btn btn-success btn-block mt-3">
                            <i class="fas fa-user-plus"></i> S'inscrire et contribuer
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Étape 2: Formulaire de contribution (caché par défaut) -->
        <div class="contribution-step" id="contributionStep" style="display: none;">
            <div class="step-header">
                <div class="step-number">2</div>
                <div class="step-title">
                    <h2>Formulaire de contribution</h2>
                    <p>Remplissez les informations sur votre contribution</p>
                </div>
            </div>

            <form id="contributionForm" class="contribution-form">
                @csrf
                <input type="hidden" id="id_auteur" name="id_auteur" value="">

                <!-- Informations de base -->
                <div class="form-section">
                    <h3><i class="fas fa-info-circle"></i> Informations de base</h3>
                    
                    <div class="form-group">
                        <label for="titre">Titre de la contribution *</label>
                        <input type="text" id="titre" name="titre" required 
                               placeholder="Titre descriptif de votre contribution">
                    </div>

                    <div class="form-group">
                        <label for="texte">Description *</label>
                        <textarea id="texte" name="texte" rows="6" required 
                                  placeholder="Décrivez en détail votre contribution..."></textarea>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="id_type_contenu">Type de contenu *</label>
                            <select id="id_type_contenu" name="id_type_contenu" required 
                                    class="form-control">
                                <option value="">Sélectionnez un type</option>
                                @foreach($typesContenu as $type)
                                    <option value="{{ $type->id_type_contenu }}">
                                        {{ $type->nom_type ?? 'Type ' . $type->id_type_contenu }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="id_region">Région *</label>
                            <select id="id_region" name="id_region" required 
                                    class="form-control">
                                <option value="">Sélectionnez une région</option>
                                @foreach($regions as $region)
                                    <option value="{{ $region->id_region }}">
                                        {{ $region->nom_region }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="id_langue_contribution">Langue du contenu *</label>
                            <select id="id_langue_contribution" name="id_langue" required 
                                    class="form-control">
                                <option value="">Sélectionnez une langue</option>
                                @foreach($langues as $langue)
                                    <option value="{{ $langue->id_langue }}">
                                        {{ $langue->nom_langue }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Médias -->
                <div class="form-section">
                    <h3><i class="fas fa-images"></i> Médias</h3>
                    
                    <div class="form-group">
                        <label for="photos">Photos (optionnel)</label>
                        <input type="file" id="photos" name="photos[]" 
                               accept="image/*" multiple class="form-control-file">
                        <small class="text-muted">Formats: JPG, PNG - Max: 5MB par fichier</small>
                        <div id="photos-preview" class="preview-container"></div>
                    </div>

                    <div class="form-group">
                        <label for="videos">Vidéos (optionnel)</label>
                        <input type="file" id="videos" name="videos[]" 
                               accept="video/*" multiple class="form-control-file">
                        <small class="text-muted">Formats: MP4, AVI - Max: 50MB par fichier</small>
                        <div id="videos-preview" class="preview-container"></div>
                    </div>
                </div>

                <!-- Boutons de soumission -->
                <div class="form-actions">
                    <button type="button" onclick="showAuthStep()" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Retour
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-paper-plane"></i> Soumettre ma contribution
                    </button>
                </div>

                <div class="form-info">
                    <p><small>* Champs obligatoires. Votre contribution sera modérée avant publication.</small></p>
                </div>
            </form>
        </div>

        <!-- Étape 3: Confirmation (caché par défaut) -->
        <div class="confirmation-step" id="confirmationStep" style="display: none;">
            <div class="confirmation-content">
                <div class="confirmation-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <h2>Contribution soumise avec succès !</h2>
                <p>Votre contribution a été enregistrée et sera examinée par nos modérateurs.</p>
                <p>Vous recevrez une notification par email une fois qu'elle sera publiée.</p>
                <div class="confirmation-actions">
                    <a href="{{ route('contenus.index') }}" class="btn btn-primary">
                        <i class="fas fa-book-open"></i> Voir toutes les contributions
                    </a>
                    <button onclick="submitAnother()" class="btn btn-outline">
                        <i class="fas fa-plus"></i> Ajouter une autre contribution
                    </button>
                </div>
            </div>
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
    --shadow: 0 4px 15px rgba(0,0,0,0.08);
    --radius: 12px;
    --transition: all 0.3s ease;
}

/* Section principale */
.contribution-section {
    padding: 2rem 0 4rem;
    background: var(--light-bg);
    min-height: 100vh;
}

.container {
    max-width: 1000px;
    margin: 0 auto;
    padding: 0 1rem;
}

/* En-tête */
.contribution-header {
    text-align: center;
    margin-bottom: 3rem;
}

.contribution-header h1 {
    color: var(--primary-color);
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
}

.contribution-header p {
    color: var(--text-light);
    font-size: 1.1rem;
    max-width: 600px;
    margin: 0 auto;
}

/* Étapes */
.auth-step, .contribution-step, .confirmation-step {
    background: white;
    border-radius: var(--radius);
    padding: 2rem;
    box-shadow: var(--shadow);
    margin-bottom: 2rem;
}

.step-header {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 2rem;
    padding-bottom: 1.5rem;
    border-bottom: 2px solid var(--light-bg);
}

.step-number {
    width: 40px;
    height: 40px;
    background: var(--secondary-color);
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 1.2rem;
    flex-shrink: 0;
}

.step-title h2 {
    margin: 0;
    color: var(--primary-color);
    font-size: 1.5rem;
    font-weight: 600;
}

.step-title p {
    margin: 0.25rem 0 0;
    color: var(--text-light);
    font-size: 0.95rem;
}

/* Options d'authentification */
.auth-options {
    display: grid;
    grid-template-columns: 1fr auto 1fr;
    gap: 2rem;
    align-items: start;
}

.auth-divider {
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
}

.auth-divider::before, .auth-divider::after {
    content: '';
    position: absolute;
    top: 50%;
    width: 100px;
    height: 1px;
    background: var(--border-color);
}

.auth-divider::before {
    right: 100%;
    margin-right: 1rem;
}

.auth-divider::after {
    left: 100%;
    margin-left: 1rem;
}

.auth-divider span {
    background: white;
    padding: 0.5rem 1rem;
    color: var(--text-light);
    font-weight: 500;
    z-index: 1;
}

.auth-form-container {
    background: var(--light-bg);
    border-radius: var(--radius);
    padding: 1.5rem;
    border: 1px solid var(--border-color);
}

.auth-form-container h3 {
    color: var(--primary-color);
    margin-bottom: 1.5rem;
    font-size: 1.2rem;
    font-weight: 600;
}

/* Formulaires */
.auth-form, .contribution-form {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.form-section {
    background: var(--light-bg);
    border-radius: var(--radius);
    padding: 1.5rem;
    margin-bottom: 1.5rem;
    border: 1px solid var(--border-color);
}

.form-section h3 {
    color: var(--primary-color);
    margin-bottom: 1rem;
    font-size: 1.1rem;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.form-group {
    margin-bottom: 1rem;
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
}

label {
    display: block;
    margin-bottom: 0.5rem;
    color: var(--primary-color);
    font-weight: 500;
    font-size: 0.95rem;
}

input, select, textarea {
    width: 100%;
    padding: 0.75rem;
    border: 1px solid var(--border-color);
    border-radius: 8px;
    font-size: 0.95rem;
    transition: var(--transition);
    background: white;
}

input:focus, select:focus, textarea:focus {
    outline: none;
    border-color: var(--secondary-color);
    box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
}

textarea {
    min-height: 150px;
    resize: vertical;
}

.form-control-file {
    border: 2px dashed var(--border-color);
    padding: 1rem;
    background: white;
    cursor: pointer;
    transition: var(--transition);
}

.form-control-file:hover {
    border-color: var(--secondary-color);
    background: #f8f9fa;
}

/* Prévisualisation des médias */
.preview-container {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
    margin-top: 1rem;
}

.preview-item {
    width: 100px;
    height: 100px;
    border-radius: 8px;
    overflow: hidden;
    position: relative;
    border: 1px solid var(--border-color);
}

.preview-item img, .preview-item video {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.remove-preview {
    position: absolute;
    top: 5px;
    right: 5px;
    width: 24px;
    height: 24px;
    background: var(--accent-color);
    color: white;
    border-radius: 50%;
    border: none;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    font-size: 0.8rem;
}

/* Cases à cocher */
.form-check {
    display: flex;
    align-items: flex-start;
    gap: 0.5rem;
    margin-top: 1rem;
}

.form-check-input {
    width: auto;
    margin-top: 0.25rem;
}

.form-check-label {
    margin: 0;
    font-size: 0.9rem;
    color: var(--text-color);
    line-height: 1.4;
}

.form-check-label a {
    color: var(--secondary-color);
    text-decoration: none;
}

.form-check-label a:hover {
    text-decoration: underline;
}

/* Boutons */
.btn {
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    font-weight: 500;
    font-size: 0.95rem;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    cursor: pointer;
    transition: var(--transition);
    border: 2px solid transparent;
}

.btn-block {
    width: 100%;
}

.btn-primary {
    background: var(--secondary-color);
    color: white;
    border-color: var(--secondary-color);
}

.btn-primary:hover {
    background: #2980b9;
    border-color: #2980b9;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(52, 152, 219, 0.3);
}

.btn-success {
    background: var(--success-color);
    color: white;
    border-color: var(--success-color);
}

.btn-success:hover {
    background: #219653;
    border-color: #219653;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(39, 174, 96, 0.3);
}

.btn-secondary {
    background: var(--text-light);
    color: white;
    border-color: var(--text-light);
}

.btn-secondary:hover {
    background: #5a6268;
    border-color: #5a6268;
    transform: translateY(-2px);
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
}

/* Actions du formulaire */
.form-actions {
    display: flex;
    justify-content: space-between;
    gap: 1rem;
    margin-top: 2rem;
}

.form-info {
    margin-top: 1rem;
    padding-top: 1rem;
    border-top: 1px solid var(--border-color);
    color: var(--text-light);
    font-size: 0.9rem;
}

/* Confirmation */
.confirmation-content {
    text-align: center;
    padding: 3rem 2rem;
}

.confirmation-icon {
    width: 100px;
    height: 100px;
    background: var(--success-color);
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 3rem;
    margin: 0 auto 2rem;
}

.confirmation-content h2 {
    color: var(--primary-color);
    margin-bottom: 1rem;
    font-size: 1.8rem;
}

.confirmation-content p {
    color: var(--text-color);
    margin-bottom: 0.5rem;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
}

.confirmation-actions {
    display: flex;
    gap: 1rem;
    justify-content: center;
    margin-top: 2rem;
}

/* Responsive */
@media (max-width: 768px) {
    .auth-options {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }
    
    .auth-divider {
        order: 2;
    }
    
    .auth-divider::before, .auth-divider::after {
        width: calc(50% - 1rem);
    }
    
    .form-row {
        grid-template-columns: 1fr;
    }
    
    .form-actions {
        flex-direction: column;
    }
    
    .confirmation-actions {
        flex-direction: column;
    }
    
    .step-header {
        flex-direction: column;
        text-align: center;
        gap: 0.75rem;
    }
}

@media (max-width: 480px) {
    .auth-step, .contribution-step, .confirmation-step {
        padding: 1.5rem 1rem;
    }
    
    .contribution-header h1 {
        font-size: 2rem;
    }
    
    .btn {
        padding: 0.75rem 1rem;
    }
}
</style>
@endpush

@push('scripts')
<script>
let currentUser = null;

// Basculer entre les étapes
function showContributionStep(userData) {
    currentUser = userData;
    document.getElementById('authStep').style.display = 'none';
    document.getElementById('contributionStep').style.display = 'block';
    document.getElementById('id_auteur').value = userData.id_utilisateur;
    document.getElementById('confirmationStep').style.display = 'none';
}

function showAuthStep() {
    document.getElementById('authStep').style.display = 'block';
    document.getElementById('contributionStep').style.display = 'none';
    document.getElementById('confirmationStep').style.display = 'none';
}

function showConfirmationStep() {
    document.getElementById('authStep').style.display = 'none';
    document.getElementById('contributionStep').style.display = 'none';
    document.getElementById('confirmationStep').style.display = 'block';
}

function submitAnother() {
    // Réinitialiser le formulaire de contribution
    document.getElementById('contributionForm').reset();
    // Revenir à l'étape de contribution
    showContributionStep(currentUser);
}

// Gestion des formulaires
document.addEventListener('DOMContentLoaded', function() {
    // Formulaire de connexion
    document.getElementById('loginForm')?.addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        
        // Afficher un indicateur de chargement
        const submitBtn = this.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Connexion...';
        submitBtn.disabled = true;
        
        try {
            const response = await fetch('/api/auth/login', {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                },
                body: formData
            });
            
            const data = await response.json();
            
            if (response.ok) {
                showContributionStep(data.user);
            } else {
                alert('Erreur: ' + (data.message || 'Email ou mot de passe incorrect'));
            }
        } catch (error) {
            console.error('Erreur:', error);
            alert('Une erreur est survenue lors de la connexion');
        } finally {
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
        }
    });

    // Formulaire d'inscription
    document.getElementById('registerForm')?.addEventListener('submit', async function(e) {
        e.preventDefault();
        
        // Vérifier les termes
        if (!document.getElementById('terms').checked) {
            alert('Veuillez accepter les conditions d\'utilisation');
            return;
        }
        
        const formData = new FormData(this);
        // Ajouter les champs par défaut
        formData.append('statut', 'actif');
        formData.append('id_role', '5');
        
        // Afficher un indicateur de chargement
        const submitBtn = this.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Inscription...';
        submitBtn.disabled = true;
        
        try {
            const response = await fetch('/api/auth/register', {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                },
                body: formData
            });
            
            const data = await response.json();
            
            if (response.ok) {
                showContributionStep(data.user);
            } else {
                alert('Erreur: ' + (data.message || 'Erreur lors de l\'inscription'));
            }
        } catch (error) {
            console.error('Erreur:', error);
            alert('Une erreur est survenue lors de l\'inscription');
        } finally {
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
        }
    });

    // Formulaire de contribution
    document.getElementById('contributionForm')?.addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        
        // Afficher un indicateur de chargement
        const submitBtn = this.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Envoi...';
        submitBtn.disabled = true;
        
        try {
            const response = await fetch('/api/contenus', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                },
                body: formData
            });
            
            const data = await response.json();
            
            if (response.ok) {
                showConfirmationStep();
            } else {
                alert('Erreur: ' + (data.message || 'Erreur lors de l\'envoi de la contribution'));
            }
        } catch (error) {
            console.error('Erreur:', error);
            alert('Une erreur est survenue lors de l\'envoi de la contribution');
        } finally {
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
        }
    });

    // Prévisualisation des photos
    document.getElementById('photos')?.addEventListener('change', function(e) {
        const preview = document.getElementById('photos-preview');
        preview.innerHTML = '';
        
        for (let file of this.files) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const div = document.createElement('div');
                div.className = 'preview-item';
                
                const img = document.createElement('img');
                img.src = e.target.result;
                img.alt = 'Preview';
                
                const removeBtn = document.createElement('button');
                removeBtn.className = 'remove-preview';
                removeBtn.innerHTML = '×';
                removeBtn.onclick = function() {
                    div.remove();
                    // Mettre à jour l'input file (solution simplifiée)
                };
                
                div.appendChild(img);
                div.appendChild(removeBtn);
                preview.appendChild(div);
            };
            reader.readAsDataURL(file);
        }
    });

    // Prévisualisation des vidéos
    document.getElementById('videos')?.addEventListener('change', function(e) {
        const preview = document.getElementById('videos-preview');
        preview.innerHTML = '';
        
        for (let file of this.files) {
            const div = document.createElement('div');
            div.className = 'preview-item';
            
            const videoIcon = document.createElement('div');
            videoIcon.style.cssText = `
                width: 100%;
                height: 100%;
                display: flex;
                align-items: center;
                justify-content: center;
                background: #f0f0f0;
                color: #666;
                font-size: 2rem;
            `;
            videoIcon.innerHTML = '<i class="fas fa-video"></i>';
            
            const fileName = document.createElement('div');
            fileName.style.cssText = `
                position: absolute;
                bottom: 0;
                left: 0;
                right: 0;
                background: rgba(0,0,0,0.7);
                color: white;
                padding: 5px;
                font-size: 0.7rem;
                text-align: center;
                word-break: break-all;
            `;
            fileName.textContent = file.name.length > 15 ? file.name.substring(0, 12) + '...' : file.name;
            
            const removeBtn = document.createElement('button');
            removeBtn.className = 'remove-preview';
            removeBtn.innerHTML = '×';
            removeBtn.onclick = function() {
                div.remove();
            };
            
            div.appendChild(videoIcon);
            div.appendChild(fileName);
            div.appendChild(removeBtn);
            preview.appendChild(div);
        }
    });
});
</script>
@endpush