@extends('dashboard.layout')

@section('content')
<section class="content-section">
    <div class="section-header">
        <h1>Ajouter un utilisateur</h1>
    </div>

    <div class="recent-activity">
        @if($errors->any())
            <div class="form-errors">
                <ul>
                    @foreach($errors->all() as $error)
                        <li style="color:#c3362e">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.utilisateurs.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>Nom</label>
                <input type="text" name="nom" value="{{ old('nom') }}">
            </div>
            <div class="form-group">
                <label>Prénom</label>
                <input type="text" name="prenom" value="{{ old('prenom') }}">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email') }}">
            </div>
            <div class="form-group">
                <label>Mot de passe</label>
                <input type="password" name="mot_de_passe">
            </div>
            <div class="form-group">
                <label>Sexe</label>
                <select name="sexe">
                    <option value="">--</option>
                    <option value="M" {{ old('sexe')=='M' ? 'selected' : '' }}>M</option>
                    <option value="F" {{ old('sexe')=='F' ? 'selected' : '' }}>F</option>
                    <option value="other" {{ old('sexe')=='other' ? 'selected' : '' }}>Autre</option>
                </select>
            </div>
            <div class="form-group">
                <label>Date de naissance</label>
                <input type="date" name="date_naissance" value="{{ old('date_naissance') }}">
            </div>
            <div class="form-group">
                <label>Date d'inscription</label>
                <input type="date" name="date_inscription" value="{{ old('date_inscription') ?: now()->toDateString() }}">
            </div>
            <div class="form-group">
                <label>Statut</label>
                <select name="statut">
                    <option value="actif" {{ old('statut')=='actif' ? 'selected' : '' }}>Actif</option>
                    <option value="inactif" {{ old('statut')=='inactif' ? 'selected' : '' }}>Inactif</option>
                </select>
            </div>
            <div class="form-group">
                <label>Photo</label>
                <input type="file" name="photo" accept="image/*">
            </div>
            <div class="form-group">
                <label>Rôle</label>
                <select name="id_role">
                    @foreach($roles as $rid => $rlabel)
                        <option value="{{ $rid }}" {{ old('id_role') == $rid ? 'selected' : '' }}>{{ $rlabel }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Langue</label>
                <select name="id_langue">
                    <option value="">-- Choisir --</option>
                    @foreach($langues ?? [] as $lang)
                        <option value="{{ $lang->id_langue }}" {{ old('id_langue') == $lang->id_langue ? 'selected' : '' }}>{{ $lang->nom_langue }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Statut</label>
                <select name="statut">
                    <option value="actif">Actif</option>
                    <option value="inactif">Inactif</option>
                </select>
            </div>

            <div class="form-actions">
                <button class="btn btn-primary" type="submit">Créer</button>
                <a href="{{ route('admin.utilisateurs.index') }}" class="btn btn-secondary">Annuler</a>
            </div>
        </form>
    </div>
</section>
@endsection
