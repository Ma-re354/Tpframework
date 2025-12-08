@extends('dashboard.layout')
@section('content')
<section class="content-section">
    <div class="section-header"><h1>Détails Contenu</h1></div>
    <div class="recent-activity">
        <div class="form-group"><label>Titre</label><input value="{{ $contenu->titre ?? '' }}" readonly></div>
        <div class="form-group"><label>Texte</label><textarea readonly>{{ $contenu->texte ?? '' }}</textarea></div>
        <div class="form-group"><label>Langue</label><input value="{{ $contenu->langue->nom_langue ?? '—' }}" readonly></div>
        <div class="form-group"><label>Auteur</label><input value="{{ optional($contenu->auteur)->nom ?? ('#' . ($contenu->id_auteur ?? '—')) }}" readonly></div>
        <a href="{{ route('admin.contenu.edit', $contenu->id_contenu) }}" class="btn btn-primary">Modifier</a>
        <a href="{{ route('admin.contenu.index') }}" class="btn btn-secondary">Retour</a>
    </div>
</section>
@endsection
