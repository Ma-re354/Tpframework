@extends('dashboard.layout')

@section('content')
<section id="deconnexion" class="content-section active">
    <div class="logout-container">
        <div class="logout-card">
            <div class="logout-icon">
                <i class="fas fa-sign-out-alt"></i>
            </div>
            <h2>Mode Démo</h2>
            <p>Dans une application réelle, vous seriez déconnecté ici.</p>
            <div class="logout-actions">
                <button class="btn btn-secondary" onclick="window.history.back()">Retour</button>
                <button class="btn btn-primary" onclick="window.location.href='/admin/dashboard'">Accueil</button>
            </div>
        </div>
    </div>
</section>
@endsection