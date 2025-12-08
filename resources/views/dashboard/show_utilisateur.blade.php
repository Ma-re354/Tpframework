@extends('dashboard.layout')

@section('content')
<section class="content-section">
    <div class="section-header">
        <h1>Détails utilisateur</h1>
    </div>

    <div class="recent-activity">
        <form>
            <div class="form-group">
                <label>Nom</label>
                <input type="text" value="{{ $user->nom ?? '' }}" readonly>
            </div>
            <div class="form-group">
                <label>Prénom</label>
                <input type="text" value="{{ $user->prenom ?? '' }}" readonly>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="text" value="{{ $user->email ?? '' }}" readonly>
            </div>
            <div class="form-group">
                <label>Rôle</label>
                <input type="text" value="{{ $user->id_role ?? '' }}" readonly>
            </div>
            <a href="{{ route('admin.utilisateurs.edit', $user->id_utilisateur) }}" class="btn btn-primary">Modifier</a>
            <a href="{{ route('admin.utilisateurs.index') }}" class="btn btn-secondary">Retour</a>
        </form>
    </div>
</section>
@endsection
