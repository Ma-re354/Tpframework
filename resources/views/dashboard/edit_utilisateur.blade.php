@extends('dashboard.layout')

@section('content')
<section class="content-section">
    <div class="section-header">
        <h1>Modifier utilisateur</h1>
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

        <form action="{{ url('/admin/utilisateurs/' . $user->id_utilisateur . '/update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>Nom</label>
                <input type="text" name="nom" value="{{ $user->nom ?? '' }}">
            </div>
            <div class="form-group">
                <label>Prénom</label>
                <input type="text" name="prenom" value="{{ $user->prenom ?? '' }}">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="{{ $user->email ?? '' }}">
            </div>
            <div class="form-group">
                <label>Mot de passe (laisser vide pour ne pas changer)</label>
                <input type="password" name="mot_de_passe">
            </div>
            <div class="form-group">
                <label>Sexe</label>
                <select name="sexe">
                    <option value="">--</option>
                    <option value="M" {{ ($user->sexe ?? '')=='M' ? 'selected' : '' }}>M</option>
                    <option value="F" {{ ($user->sexe ?? '')=='F' ? 'selected' : '' }}>F</option>
                    <option value="other" {{ ($user->sexe ?? '')=='other' ? 'selected' : '' }}>Autre</option>
                </select>
            </div>
            <div class="form-group">
                <label>Date de naissance</label>
                <input type="date" name="date_naissance" value="{{ $user->date_naissance ?? '' }}">
            </div>
            <div class="form-group">
                <label>Date d'inscription</label>
                <input type="date" name="date_inscription" value="{{ $user->date_inscription ?? '' }}">
            </div>
            <div class="form-group">
                <label>Statut</label>
                <select name="statut">
                    <option value="actif" {{ ($user->statut ?? '')=='actif' ? 'selected' : '' }}>Actif</option>
                    <option value="inactif" {{ ($user->statut ?? '')=='inactif' ? 'selected' : '' }}>Inactif</option>
                </select>
            </div>
            <div class="form-group">
                <label>Photo</label>
                @if(!empty($user->photo))
                    <div style="margin-bottom:8px"><img src="{{ asset('storage/' . $user->photo) }}" alt="photo" style="max-width:120px;border-radius:6px"></div>
                @endif
                <input type="file" name="photo" accept="image/*">
            </div>
            <div class="form-group">
                <label>Rôle</label>
                <select name="id_role">
                    @foreach($roles as $rid => $rlabel)
                        <option value="{{ $rid }}" {{ ($user->id_role ?? '') == $rid ? 'selected' : '' }}>{{ $rlabel }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Langue</label>
                <select name="id_langue">
                    <option value="">-- Choisir --</option>
                    @foreach($langues ?? [] as $lang)
                        <option value="{{ $lang->id_langue }}" {{ ($user->id_langue ?? '') == $lang->id_langue ? 'selected' : '' }}>{{ $lang->nom_langue }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-actions">
                <button class="btn btn-primary" type="submit">Enregistrer</button>
                <a href="{{ route('admin.utilisateurs.index') }}" class="btn btn-secondary">Annuler</a>
            </div>
        </form>
    </div>
</section>
@endsection
