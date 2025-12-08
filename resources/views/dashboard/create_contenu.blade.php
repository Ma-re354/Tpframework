@extends('dashboard.layout')

@section('content')
<section class="content-section">
    <div class="section-header">
        <h1>Ajouter une recette</h1>
    </div>

    <div class="recent-activity">
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.contenu.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="form-group">
                <label>Titre *</label>
                <input type="text" name="titre" value="{{ old('titre') }}" required>
            </div>
            
            <div class="form-group">
                <label>Texte *</label>
                <textarea name="texte" rows="6" required>{{ old('texte') }}</textarea>
            </div>
            
            <div class="form-group">
                <label>Région *</label>
                <select name="id_region" required>
                    <option value="">-- Choisir une région --</option>
                    @foreach($regions ?? [] as $region)
                        <option value="{{ $region->id_region }}" {{ old('id_region') == $region->id_region ? 'selected' : '' }}>
                            {{ $region->nom_region }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <div class="form-group">
                <label>Langue *</label>
                <select name="id_langue" required>
                    <option value="">-- Choisir une langue --</option>
                    @foreach($langues ?? [] as $langue)
                        <option value="{{ $langue->id_langue }}" {{ old('id_langue') == $langue->id_langue ? 'selected' : '' }}>
                            {{ $langue->nom_langue }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <div class="form-group">
                <label>Auteur *</label>
                <select name="id_auteur" required>
                    <option value="">-- Choisir un auteur --</option>
                    @foreach($users ?? [] as $user)
                        <option value="{{ $user->id_utilisateur }}" {{ old('id_auteur') == $user->id_utilisateur ? 'selected' : '' }}>
                            {{ $user->nom }} {{ $user->prenom }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <div class="form-group">
                <label>Modérateur</label>
                <select name="id_moderateur">
                    <option value="">-- Choisir un modérateur --</option>
                    @foreach($moderateurs ?? [] as $moderateur)
                        <option value="{{ $moderateur->id_utilisateur }}" {{ old('id_moderateur') == $moderateur->id_utilisateur ? 'selected' : '' }}>
                            {{ $moderateur->nom }} {{ $moderateur->prenom }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <div class="form-group">
                <label>Type de contenu</label>
                <select name="id_type_contenu">
                    <option value="1" {{ old('id_type_contenu', 1) == 1 ? 'selected' : '' }}>Recette</option>
                    <option value="2" {{ old('id_type_contenu') == 2 ? 'selected' : '' }}>Article</option>
                    <option value="3" {{ old('id_type_contenu') == 3 ? 'selected' : '' }}>Histoire</option>
                </select>
            </div>

            <!-- Photos multiples -->
            <div class="form-group">
                <label>Photos</label>
                <input type="file" name="photos[]" multiple accept="image/*" class="form-control">
                <small class="text-muted">Formats: JPG, PNG, GIF, WebP (max 5MB par image). Sélectionnez plusieurs fichiers.</small>
            </div>

            <!-- Vidéos multiples -->
            <div class="form-group">
                <label>Vidéos</label>
                <input type="file" name="videos[]" multiple accept="video/*" class="form-control">
                <small class="text-muted">Formats: MP4, AVI, MOV, WMV (max 20MB par vidéo). Sélectionnez plusieurs fichiers.</small>
            </div>

            <div class="form-actions">
                <button class="btn btn-primary" type="submit">Créer</button>
                <a href="{{ route('admin.contenu.index') }}" class="btn btn-secondary">Annuler</a>
            </div>
        </form>
    </div>
</section>
@endsection