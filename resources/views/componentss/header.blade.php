<header class="header" id="header">
    <div class="container">
        <nav class="navbar navbar-expand-lg">
            <!-- Logo avec image -->
            <a href="{{ route('home') }}" class="logo">
                <div class="logo-container">
                    <img src="{{ asset('css/image.png') }}" alt="Bénin Culture" class="logo-img">
                    <div class="logo-text">
                        <span class="logo-title">Bénin Culture</span>
                        <span class="logo-subtitle">Patrimoine & Langues</span>
                    </div>
                </div>
            </a>

            <!-- Menu burger pour mobile -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" 
                    aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon">
                    <i class="fas fa-bars"></i>
                </span>
            </button>

            <!-- Contenu de la navbar -->
            <div class="collapse navbar-collapse" id="navbarContent">
                <!-- Menu de navigation CENTRÉ -->
                <ul class="navbar-nav mx-auto"> <!-- Ajout de mx-auto pour centrer -->
                    <li class="nav-item">
                        <a href="{{ route('contenus.index') }}" class="nav-link {{ request()->routeIs('contenus.*') ? 'active' : '' }}">
                            <span>Contenus</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('langues.index') }}" class="nav-link {{ request()->routeIs('langues.*') ? 'active' : '' }}">
                            <span>Langues</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('regions.index') }}" class="nav-link {{ request()->routeIs('regions.*') ? 'active' : '' }}">
                            <span>Régions</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('contribuer') }}" class="nav-link {{ request()->routeIs('contribuer') ? 'active' : '' }}">
                            <span>Contribuer</span>
                        </a>
                    </li>
                </ul>

                <!-- Boutons connexion / déconnexion -->
                <div class="auth-section">
                    @auth
                        <!-- Menu utilisateur avec dropdown -->
                        <div class="user-dropdown dropdown">
                            <button class="user-btn dropdown-toggle" type="button" id="userDropdown" 
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="user-avatar">
                                    @if(Auth::user()->avatar)
                                        <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="{{ Auth::user()->name }}">
                                    @else
                                        <i class="fas fa-user-circle"></i>
                                    @endif
                                </div>
                                <span class="user-name">{{ Auth::user()->name ?? Auth::user()->email }}</span>
                                <i class="fas fa-chevron-down"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <li>
                                    <a class="dropdown-item" href="{{ route('dashboard.accueil') }}">
                                        <i class="fas fa-tachometer-alt"></i> Tableau de bord
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                        <i class="fas fa-user-edit"></i> Mon profil
                                    </a>
                                </li>
                               
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item logout-btn">
                                            <i class="fas fa-sign-out-alt"></i> Déconnexion
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @else
                        <div class="auth-buttons">
                            <a href="{{ route('login') }}" class="btn btn-outline-primary">
                                <i class="fas fa-sign-in-alt"></i>
                                <span>Connexion</span>
                            </a>
                            <a href="{{ route('register') }}" class="btn btn-primary">
                                <i class="fas fa-user-plus"></i>
                                <span>S'inscrire</span>
                            </a>
                        </div>
                    @endauth
                </div>
            </div>
        </nav>
    </div>
</header>

<!-- CSS amélioré pour le header avec menu centré -->
<style>
    .header {
        background: white;
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
        position: sticky;
        top: 0;
        z-index: 1000;
        transition: all 0.3s ease;
    }

    .header.scrolled {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
    }

    .navbar {
        padding: 0.8rem 0;
        display: flex;
        align-items: center;
        position: relative;
    }

    /* Logo amélioré */
    .logo {
        text-decoration: none;
        color: inherit;
        z-index: 2;
    }

    .logo-container {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .logo-img {
        width: 65px;
        height: 65px;
        object-fit: contain;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
    }

    .logo:hover .logo-img {
        transform: scale(1.05);
    }

    .logo-text {
        display: flex;
        flex-direction: column;
    }

    .logo-title {
        font-size: 1.4rem;
        font-weight: 800;
        color: #2d6cdf;
        line-height: 1.2;
    }

    .logo-subtitle {
        font-size: 0.85rem;
        color: #666;
        font-weight: 500;
        letter-spacing: 0.5px;
    }

    /* Bouton burger mobile */
    .navbar-toggler {
        border: none;
        background: transparent;
        padding: 0.5rem;
        cursor: pointer;
        z-index: 2;
    }

    .navbar-toggler-icon {
        font-size: 1.5rem;
        color: #2d6cdf;
    }

    /* Navigation principale - CENTRÉE */
    .navbar-collapse {
        flex-grow: 1;
        justify-content: center;
    }

    .navbar-nav {
        display: flex;
        list-style: none;
        margin: 0;
        padding: 0;
        gap: 1.5rem;
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
    }

    .nav-item {
        position: relative;
    }

    .nav-link {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 0.8rem 1.5rem;
        text-decoration: none;
        color: #444;
        font-weight: 600;
        border-radius: 10px;
        transition: all 0.3s ease;
        position: relative;
        font-size: 1.05rem;
        min-width: 120px;
        text-align: center;
    }

    .nav-link:hover {
        background: rgba(45, 108, 223, 0.08);
        color: #2d6cdf;
        transform: translateY(-2px);
    }

    .nav-link.active {
        background: linear-gradient(135deg, #2d6cdf, #4a90e2);
        color: white;
        box-shadow: 0 4px 12px rgba(45, 108, 223, 0.3);
    }

    .nav-link.active::after {
        content: '';
        position: absolute;
        bottom: -5px;
        left: 50%;
        transform: translateX(-50%);
        width: 30px;
        height: 3px;
        background: white;
        border-radius: 2px;
    }

    /* Animation de soulignement au hover */
    .nav-link::before {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 50%;
        width: 0;
        height: 3px;
        background: #2d6cdf;
        transition: all 0.3s ease;
        transform: translateX(-50%);
        border-radius: 2px;
    }

    .nav-link:hover::before {
        width: 60%;
    }

    /* Section authentification */
    .auth-section {
        margin-left: auto; /* Pousse la section auth à droite */
        display: flex;
        align-items: center;
        z-index: 2;
    }

    /* Boutons authentification */
    .auth-buttons {
        display: flex;
        gap: 0.8rem;
        align-items: center;
    }

    .btn-outline-primary {
        border: 2px solid #2d6cdf;
        color: #2d6cdf;
        background: transparent;
        padding: 0.6rem 1.2rem;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-outline-primary:hover {
        background: #2d6cdf;
        color: white;
        transform: translateY(-2px);
    }

    .btn-primary {
        background: linear-gradient(135deg, #2d6cdf, #4a90e2);
        color: white;
        border: none;
        padding: 0.6rem 1.2rem;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(45, 108, 223, 0.4);
    }

    /* Menu utilisateur dropdown */
    .user-dropdown {
        position: relative;
    }

    .user-btn {
        display: flex;
        align-items: center;
        gap: 10px;
        background: transparent;
        border: none;
        padding: 0.5rem 1rem;
        border-radius: 50px;
        cursor: pointer;
        transition: all 0.3s ease;
        background: rgba(45, 108, 223, 0.08);
    }

    .user-btn:hover {
        background: rgba(45, 108, 223, 0.15);
    }

    .user-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #2d6cdf, #4a90e2);
        color: white;
    }

    .user-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .user-avatar i {
        font-size: 1.5rem;
    }

    .user-name {
        font-weight: 500;
        color: #333;
        max-width: 150px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    /* Dropdown menu */
    .dropdown-menu {
        border: none;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        border-radius: 12px;
        padding: 0.5rem;
        margin-top: 10px;
        animation: fadeIn 0.2s ease;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .dropdown-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 0.75rem 1rem;
        border-radius: 8px;
        color: #444;
        font-weight: 500;
        transition: all 0.2s ease;
    }

    .dropdown-item:hover {
        background: rgba(45, 108, 223, 0.1);
        color: #2d6cdf;
        transform: translateX(5px);
    }

    .dropdown-item i {
        width: 20px;
        text-align: center;
    }

    .logout-btn {
        color: #dc3545;
    }

    .logout-btn:hover {
        background: rgba(220, 53, 69, 0.1);
        color: #dc3545;
    }

    /* Responsive Design */
    @media (max-width: 1200px) {
        .navbar-nav {
            gap: 1rem;
        }
        
        .nav-link {
            padding: 0.8rem 1.2rem;
            min-width: 100px;
        }
    }

    @media (max-width: 992px) {
        .navbar-toggler {
            display: block;
        }

        .navbar-collapse {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: white;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border-radius: 0 0 12px 12px;
            padding: 1.5rem;
            display: none;
        }

        .navbar-collapse.show {
            display: block;
        }

        .navbar-nav {
            position: static;
            transform: none;
            flex-direction: column;
            gap: 0.8rem;
            margin-bottom: 1.5rem;
            width: 100%;
        }

        .nav-link {
            justify-content: flex-start;
            padding: 1rem;
            min-width: auto;
            width: 100%;
            border-radius: 8px;
        }

        .auth-section {
            margin-left: 0;
            justify-content: center;
            width: 100%;
        }

        .auth-buttons {
            width: 100%;
            justify-content: center;
            flex-direction: column;
        }

        .user-btn {
            width: 100%;
            justify-content: center;
        }
        
        .btn-outline-primary,
        .btn-primary {
            width: 100%;
            text-align: center;
        }
    }

    @media (max-width: 576px) {
        .logo-container {
            flex-direction: row;
            text-align: left;
            gap: 10px;
        }

        .logo-img {
            width: 50px;
            height: 50px;
        }

        .logo-title {
            font-size: 1.2rem;
        }

        .logo-subtitle {
            font-size: 0.75rem;
        }
        
        .navbar-toggler {
            margin-left: auto;
        }
        
        .auth-buttons {
            flex-direction: column;
            width: 100%;
        }
    }

    /* Pour les très grands écrans */
    @media (min-width: 1400px) {
        .navbar-nav {
            gap: 2rem;
        }
        
        .nav-link {
            padding: 0.8rem 2rem;
            min-width: 140px;
            font-size: 1.1rem;
        }
    }
</style>

<!-- Script pour le dropdown Bootstrap -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialiser les dropdowns Bootstrap
        const dropdownElementList = [].slice.call(document.querySelectorAll('.dropdown-toggle'))
        const dropdownList = dropdownElementList.map(function (dropdownToggleEl) {
            return new bootstrap.Dropdown(dropdownToggleEl)
        })

        // Animation du header au scroll
        window.addEventListener('scroll', function() {
            const header = document.getElementById('header');
            if (window.scrollY > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });

        // Fermer le menu mobile quand on clique sur un lien
        const navLinks = document.querySelectorAll('.nav-link');
        const navbarCollapse = document.querySelector('.navbar-collapse');
        
        navLinks.forEach(link => {
            link.addEventListener('click', () => {
                if (navbarCollapse.classList.contains('show')) {
                    bootstrap.Collapse.getInstance(navbarCollapse).hide();
                }
            });
        });
    });
</script>