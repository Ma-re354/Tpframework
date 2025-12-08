<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de Contribution</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .form-section {
            display: none;
        }
        .form-section.active {
            display: block;
            animation: fadeIn 0.5s ease;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .tab {
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .tab.active {
            background-color: #3b82f6;
            color: white;
        }
        .preview-image {
            max-width: 150px;
            max-height: 150px;
            object-fit: cover;
            border-radius: 8px;
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">
    <div class="container mx-auto px-4 py-8 max-w-4xl">
        <!-- En-tête -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Formulaire de Contribution</h1>
            <p class="text-gray-600">Partagez votre contenu avec notre communauté</p>
        </div>

        <!-- Étapes -->
        <div class="flex justify-center mb-8">
            <div class="flex space-x-4">
                <div class="flex items-center">
                    <div class="w-8 h-8 rounded-full bg-blue-500 text-white flex items-center justify-center tab" data-target="auth-section">1</div>
                    <div class="ml-2">Authentification</div>
                </div>
                <div class="flex items-center">
                    <div class="w-8 h-8 rounded-full bg-gray-300 text-gray-600 flex items-center justify-center tab" data-target="contribution-section">2</div>
                    <div class="ml-2 text-gray-500">Contribution</div>
                </div>
            </div>
        </div>

        <!-- Section d'authentification -->
        <div id="auth-section" class="form-section active bg-white rounded-lg shadow-lg p-6 mb-6">
            <div class="flex border-b mb-6">
                <button id="login-tab" class="tab px-6 py-3 font-medium text-gray-700 border-b-2 border-transparent hover:text-blue-600 active" data-form="login-form">Connexion</button>
                <button id="register-tab" class="tab px-6 py-3 font-medium text-gray-700 border-b-2 border-transparent hover:text-blue-600" data-form="register-form">Inscription</button>
            </div>

            <!-- Formulaire de connexion -->
            <div id="login-form" class="auth-form">
                <form id="loginForm">
                    @csrf
                    <div class="mb-4">
                        <label for="login-email" class="block text-gray-700 mb-2">Email</label>
                        <input type="email" id="login-email" name="email" required 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div class="mb-6">
                        <label for="login-password" class="block text-gray-700 mb-2">Mot de passe</label>
                        <input type="password" id="login-password" name="password" required 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition duration-300">
                        Se connecter
                    </button>
                </form>
            </div>

            <!-- Formulaire d'inscription -->
            <div id="register-form" class="auth-form hidden">
                <form id="registerForm" enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="nom" class="block text-gray-700 mb-2">Nom *</label>
                            <input type="text" id="nom" name="nom" required 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label for="prenom" class="block text-gray-700 mb-2">Prénom *</label>
                            <input type="text" id="prenom" name="prenom" required 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div class="md:col-span-2">
                            <label for="email" class="block text-gray-700 mb-2">Email *</label>
                            <input type="email" id="email" name="email" required 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label for="password" class="block text-gray-700 mb-2">Mot de passe *</label>
                            <input type="password" id="password" name="password" required 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label for="sexe" class="block text-gray-700 mb-2">Sexe</label>
                            <select id="sexe" name="sexe" 
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Sélectionnez</option>
                                <option value="M">Masculin</option>
                                <option value="F">Féminin</option>
                            </select>
                        </div>
                        <div>
                            <label for="date_naissance" class="block text-gray-700 mb-2">Date de naissance</label>
                            <input type="date" id="date_naissance" name="date_naissance" 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label for="id_langue" class="block text-gray-700 mb-2">Langue</label>
                            <select id="id_langue" name="id_langue" 
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Sélectionnez une langue</option>
                                @foreach($langues as $langue)
                                    <option value="{{ $langue->id_langue }}">{{ $langue->nom_langue }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="photo" class="block text-gray-700 mb-2">Photo de profil</label>
                            <input type="file" id="photo" name="photo" accept="image/*" 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>
                    
                    <div class="mt-4 mb-6">
                        <label class="flex items-center">
                            <input type="checkbox" name="terms" required 
                                   class="mr-2 rounded focus:ring-blue-500">
                            <span class="text-gray-700">J'accepte les conditions d'utilisation *</span>
                        </label>
                    </div>
                    
                    <button type="submit" class="w-full bg-green-500 text-white py-2 px-4 rounded-lg hover:bg-green-600 transition duration-300">
                        S'inscrire
                    </button>
                </form>
            </div>

            <div id="auth-message" class="mt-4 text-center hidden"></div>
        </div>

        <!-- Section de contribution (cachée initialement) -->
        <div id="contribution-section" class="form-section bg-white rounded-lg shadow-lg p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Formulaire de Contribution</h2>
            
            <form id="contributionForm" enctype="multipart/form-data">
                @csrf
                <div class="space-y-6">
                    <!-- Informations de l'utilisateur connecté -->
                    <div id="user-info" class="bg-blue-50 p-4 rounded-lg mb-4 hidden">
                        <h3 class="font-semibold text-blue-800">Connecté en tant que :</h3>
                        <p id="user-name" class="text-blue-700"></p>
                    </div>

                    <input type="hidden" id="id_auteur" name="id_auteur">

                    <div>
                        <label for="titre" class="block text-gray-700 mb-2">Titre *</label>
                        <input type="text" id="titre" name="titre" required 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label for="texte" class="block text-gray-700 mb-2">Texte *</label>
                        <textarea id="texte" name="texte" rows="6" required 
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label for="id_type_contenu" class="block text-gray-700 mb-2">Type de contenu *</label>
                            <select id="id_type_contenu" name="id_type_contenu" required 
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Sélectionnez</option>
                                @foreach($typesContenu as $type)
                                    <option value="{{ $type->id_type_contenu }}">{{ $type->nom_contenu }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="id_region" class="block text-gray-700 mb-2">Région *</label>
                            <select id="id_region" name="id_region" required 
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Sélectionnez</option>
                                @foreach($regions as $region)
                                    <option value="{{ $region->id_region }}">{{ $region->nom_region }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="contenu_id_langue" class="block text-gray-700 mb-2">Langue du contenu *</label>
                            <select id="contenu_id_langue" name="id_langue" required 
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Sélectionnez</option>
                                @foreach($langues as $langue)
                                    <option value="{{ $langue->id_langue }}">{{ $langue->nom_langue }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Photos -->
                    <div>
                        <label class="block text-gray-700 mb-2">Photos (optionnel)</label>
                        <input type="file" id="photos" name="photos[]" multiple accept="image/*" 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <div id="photos-preview" class="mt-2 flex flex-wrap gap-2"></div>
                    </div>

                    <!-- Vidéos -->
                    <div>
                        <label class="block text-gray-700 mb-2">Vidéos (optionnel)</label>
                        <input type="file" id="videos" name="videos[]" multiple accept="video/*" 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <div id="videos-preview" class="mt-2"></div>
                    </div>

                    <div class="flex justify-between pt-4">
                        <button type="button" id="back-to-auth" 
                                class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition duration-300">
                            ← Retour
                        </button>
                        <button type="submit" 
                                class="px-6 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition duration-300">
                            Soumettre la contribution
                        </button>
                    </div>
                </div>
            </form>

            <div id="contribution-message" class="mt-4 text-center hidden"></div>
        </div>
    </div>

   <script>
    // Variables globales
    let currentUser = null;
    let csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}';

    // Gestion des onglets d'authentification
    document.addEventListener('DOMContentLoaded', function() {
        // Initialiser les onglets
        initTabs();
        
        // Ajouter le token CSRF aux formulaires
        addCsrfTokenToForms();
    });

    function initTabs() {
        // Onglets Connexion/Inscription
        document.querySelectorAll('[data-form]').forEach(tab => {
            tab.addEventListener('click', function() {
                // Supprimer les classes actives de tous les onglets
                document.querySelectorAll('.tab').forEach(t => {
                    t.classList.remove('active', 'border-blue-500');
                    t.classList.remove('bg-blue-500', 'text-white');
                });
                
                // Ajouter les classes à l'onglet cliqué
                this.classList.add('active', 'border-blue-500');
                
                // Cacher tous les formulaires
                document.querySelectorAll('.auth-form').forEach(form => {
                    form.classList.add('hidden');
                });
                
                // Afficher le formulaire correspondant
                const formId = this.getAttribute('data-form');
                document.getElementById(formId).classList.remove('hidden');
            });
        });

        // Onglets des étapes (Authentification/Contribution)
        document.querySelectorAll('.tab[data-target]').forEach(tab => {
            tab.addEventListener('click', function() {
                const target = this.getAttribute('data-target');
                
                if(target === 'contribution-section' && !currentUser) {
                    showMessage('auth-message', 'Veuillez vous connecter ou vous inscrire d\'abord', 'error');
                    return;
                }
                
                // Mettre à jour l'affichage des onglets
                document.querySelectorAll('.tab[data-target]').forEach(t => {
                    t.classList.remove('bg-blue-500', 'text-white');
                    t.classList.add('bg-gray-300', 'text-gray-600');
                });
                
                this.classList.remove('bg-gray-300', 'text-gray-600');
                this.classList.add('bg-blue-500', 'text-white');
                
                // Afficher la section correspondante
                document.querySelectorAll('.form-section').forEach(section => {
                    section.classList.remove('active');
                });
                document.getElementById(target).classList.add('active');
            });
        });
    }

    function addCsrfTokenToForms() {
        // Ajouter le token CSRF aux formulaires
        const forms = ['loginForm', 'registerForm', 'contributionForm'];
        forms.forEach(formId => {
            const form = document.getElementById(formId);
            if (form) {
                const csrfInput = form.querySelector('input[name="_token"]');
                if (!csrfInput) {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = '_token';
                    input.value = csrfToken;
                    form.appendChild(input);
                }
            }
        });
    }

    // Formulaire de connexion
    document.getElementById('loginForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        console.log('Tentative de connexion...');
        
        const email = document.getElementById('login-email').value;
        const password = document.getElementById('login-password').value;
        
        if (!email || !password) {
            showMessage('auth-message', 'Veuillez remplir tous les champs', 'error');
            return;
        }
        
        try {
            const response = await fetch('/auth/login', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({
                    email: email,
                    password: password
                })
            });
            
            console.log('Réponse du serveur:', response.status);
            const data = await response.json();
            console.log('Données reçues:', data);
            
            if(response.ok) {
                currentUser = data.user;
                handleAuthSuccess();
            } else {
                showMessage('auth-message', data.message || 'Erreur de connexion', 'error');
            }
        } catch(error) {
            console.error('Erreur:', error);
            showMessage('auth-message', 'Erreur de connexion au serveur', 'error');
        }
    });

    // Formulaire d'inscription
    document.getElementById('registerForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        console.log('Tentative d\'inscription...');
        
        const formData = new FormData(this);
        
        // Validation simple
        const requiredFields = ['nom', 'prenom', 'email', 'password', 'terms'];
for (let field of requiredFields) {
    if (!formData.get(field)) {
        showMessage('auth-message', `Le champ ${field} est requis`, 'error');
        return;
    }
}
        
        try {
            const response = await fetch('/auth/register', {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: formData
            });
            
            console.log('Réponse inscription:', response.status);
            const data = await response.json();
            console.log('Données inscription:', data);
            
            if(response.ok) {
                currentUser = data.user;
                handleAuthSuccess();
            } else {
                const errorMsg = data.errors ? Object.values(data.errors).flat().join(', ') : data.message;
                showMessage('auth-message', errorMsg || 'Erreur d\'inscription', 'error');
            }
        } catch(error) {
            console.error('Erreur inscription:', error);
            showMessage('auth-message', 'Erreur de connexion au serveur', 'error');
        }
    });

    // Formulaire de contribution
    document.getElementById('contributionForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        console.log('Tentative de soumission de contribution...');
        
        if(!currentUser) {
            showMessage('contribution-message', 'Veuillez vous authentifier', 'error');
            return;
        }
        
        const formData = new FormData(this);
        formData.append('id_auteur', currentUser.id);
        
        // Validation des champs requis
        const requiredFields = ['titre', 'texte', 'id_type_contenu', 'id_region', 'id_langue'];
        for (let field of requiredFields) {
            if (!formData.get(field)) {
                showMessage('contribution-message', `Le champ ${field} est requis`, 'error');

                return;
            }
        }
        
        try {
            const response = await fetch('/contenus', {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: formData
            });
            
            const data = await response.json();
            console.log('Réponse contribution:', data);
            
            if(response.ok) {
                showMessage('contribution-message', data.message, 'success');
                // Réinitialiser le formulaire
                this.reset();
                document.getElementById('photos-preview').innerHTML = '';
                document.getElementById('videos-preview').innerHTML = '';
            } else {
                const errorMsg = data.errors ? Object.values(data.errors).flat().join(', ') : data.message;
                showMessage('contribution-message', errorMsg || 'Erreur de soumission', 'error');
            }
        } catch(error) {
            console.error('Erreur contribution:', error);
            showMessage('contribution-message', 'Erreur de connexion au serveur', 'error');
        }
    });

    // Prévisualisation des photos
    document.getElementById('photos')?.addEventListener('change', function(e) {
        const preview = document.getElementById('photos-preview');
        if (!preview) return;
        
        preview.innerHTML = '';
        
        Array.from(this.files).forEach(file => {
            if(file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.className = 'preview-image';
                    preview.appendChild(img);
                }
                reader.readAsDataURL(file);
            }
        });
    });

    // Retour à l'authentification
    document.getElementById('back-to-auth')?.addEventListener('click', function() {
        if (document.querySelector('.tab[data-target="auth-section"]')) {
            document.querySelector('.tab[data-target="auth-section"]').click();
        }
    });

    // Fonctions utilitaires
    function handleAuthSuccess() {
        console.log('Authentification réussie pour:', currentUser);
        
        // Afficher les informations de l'utilisateur
        const userInfo = document.getElementById('user-info');
        const userName = document.getElementById('user-name');
        
        if (userInfo && userName) {
            userInfo.classList.remove('hidden');
            userName.textContent = `${currentUser.prenom} ${currentUser.nom}`;

        }
        
        // Remplir le champ id_auteur
        const idAuteurInput = document.getElementById('id_auteur');
        if (idAuteurInput) {
            idAuteurInput.value = currentUser.id;
        }
        
        showMessage('auth-message', 'Authentification réussie ! Redirection...', 'success');
        
        // Passer à l'étape suivante après 1 seconde
        setTimeout(() => {
            const contributionTab = document.querySelector('.tab[data-target="contribution-section"]');
            if (contributionTab) {
                contributionTab.click();
            }
        }, 1000);
    }

    function showMessage(elementId, message, type) {
        const element = document.getElementById(elementId);
        if (!element) return;
        
        element.textContent = message;
        element.className = 'mt-4 text-center p-3 rounded-lg font-medium ';
        
        if (type === 'success') {
            element.classList.add('bg-green-100', 'text-green-800', 'border', 'border-green-200');
        } else {
            element.classList.add('bg-red-100', 'text-red-800', 'border', 'border-red-200');
        }
        
        element.classList.remove('hidden');
        
        // Cacher le message après 5 secondes
        setTimeout(() => {
            element.classList.add('hidden');
        }, 5000);
    }

    // Permettre de tester avec des données prédéfinies (pour le développement)
    function fillTestData() {
        // Remplir avec des données de test pour le développement
        document.getElementById('login-email').value = 'test@example.com';
        document.getElementById('login-password').value = 'password123';
    }

    // Appeler fillTestData() pour le développement (à supprimer en production)
    // fillTestData();
</script>
</body>
</html>