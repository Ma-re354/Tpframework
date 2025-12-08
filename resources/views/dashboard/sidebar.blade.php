<aside class="sidebar">
    <!-- Header avec image -->
    <div class="sidebar-header">
        <img src="{{ asset('admin/DrapeauBenin.jpg') }}" alt="Drapeau Bénin" class="sidebar-logo" />
    </div>

    <!-- Navigation -->
    <nav class="sidebar-nav">
        <ul>
            <li>
                <a href="{{ route('admin.accueil') }}" 
                   class="nav-link {{ request()->is('admin/accueil') ? 'active' : '' }}">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li>
                <a href="{{ route('admin.utilisateurs.index') }}" 
                   class="nav-link {{ request()->is('admin/utilisateurs*') ? 'active' : '' }}">
                    <i class="fas fa-users"></i>
                    <span>Utilisateurs</span>
                </a>
            </li>

            <li>
                <a href="{{ route('admin.regions.index') }}"
                   class="nav-link {{ request()->is('admin/regions*') ? 'active' : '' }}">
                    <i class="fas fa-map-marked-alt"></i>
                    <span>Régions</span>
                </a>
            </li>

            <li>
                <a href="{{ route('admin.langues.index') }}" 
                   class="nav-link {{ request()->is('admin/langues*') ? 'active' : '' }}">
                    <i class="fas fa-language"></i>
                    <span>Langues</span>
                </a>
            </li>

            <li>
                <a href="{{ route('admin.contenu.index') }}" 
                   class="nav-link {{ request()->is('admin/recettes*') ? 'active' : '' }}">
                    <i class="fas fa-file-alt"></i>
                    <span>Contenus</span>
                </a>
            </li>

            <li class="has-submenu">
                <a href="#" class="nav-toggle">
                    <i class="fas fa-cog"></i>
                    <span>Paramètres</span>
                    <i class="fas fa-chevron-down dropdown-icon"></i>
                </a>
                <ul class="submenu">
                    <li>
                        <a href="{{ route('admin.mot-de-passe') }}"
                           class="{{ request()->is('admin/mot-de-passe') ? 'active' : '' }}">
                           Changer mot de passe
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.deconnexion') }}"
                           class="{{ request()->is('admin/deconnexion') ? 'active' : '' }}">
                           Se déconnecter
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
</aside>

<!-- Script pour le toggle submenu -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var toggles = document.querySelectorAll('.nav-toggle');
        toggles.forEach(function(toggle) {
            toggle.addEventListener('click', function(e) {
                e.preventDefault();
                var parent = toggle.closest('.has-submenu');
                if (!parent) return;
                parent.classList.toggle('active');
            });
        });
    });
</script>

<!-- CSS -->
<style>
.sidebar {
    width: 220px;
    background-color: #064888; /* exemple couleur sidebar */
    color: #fff;
    height: 100vh;
    padding-top: 10px;
}

.sidebar-header {
    text-align: center;
    padding: 15px 0;
}

.sidebar-logo {
    width: 80px;
    height: auto;
    border-radius: 8px;
    display: inline-block;
}

.sidebar-nav ul {
    list-style: none;
    padding: 0;
}

.sidebar-nav ul li {
    margin-bottom: 5px;
}

.nav-link {
    display: flex;
    align-items: center;
    padding: 10px 15px;
    color: #fff;
    text-decoration: none;
    border-radius: 4px;
    transition: background 0.3s;
}

.nav-link i {
    margin-right: 10px;
}

.nav-link.active,
.nav-link:hover {
    background-color: #06a8a8; /* survol ou actif */
}

.has-submenu .submenu {
    display: none;
    padding-left: 20px;
}

.has-submenu.active .submenu {
    display: block;
}
</style>