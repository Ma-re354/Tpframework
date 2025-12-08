<header class="top-bar">
    <div class="user-info">
        <div class="user-avatar">
            <i class="fas fa-user-circle"></i>
        </div>
        <span class="user-name">Administrateur</span>
        @if (Auth::check())
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-button">
                    <i class="fas fa-sign-out-alt"></i> Déconnexion
                </button>
            </form>
        @endif
    </div>
</header>