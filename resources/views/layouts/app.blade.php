<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Title dynamique -->
    <title>@yield('title', 'Bénin Culture - Patrimoine Culturel et Linguistique')</title>

    <!-- Fonts + Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Merriweather:wght@300;400;700;900&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS (CRITIQUE - manquant) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Votre style principal -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    
    <!-- Styles spécifiques aux pages (manquant) -->
    @stack('styles')
    
    @yield('head')
</head>
<body>

    {{-- HEADER GLOBAL --}}
    @include('componentss.header')

    {{-- CONTENU DES PAGES --}}
    <main class="main-content">
        @yield('content')
    </main>

    {{-- FOOTER GLOBAL --}}
    @include('componentss.footer')

    <!-- Bootstrap JS + Popper -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    
    <!-- jQuery (nécessaire pour Bootstrap modal) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- Votre script principal -->
    <script src="{{ asset('js/main.js') }}"></script>
    
    <!-- Scripts spécifiques aux pages -->
    @stack('scripts')

    <script>
        // Animation du header au scroll
        window.addEventListener('scroll', function() {
            const header = document.getElementById('header');
            if (window.scrollY > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });
    </script>

</body>
</html>