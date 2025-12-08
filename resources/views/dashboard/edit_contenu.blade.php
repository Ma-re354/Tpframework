@extends('dashboard.layout')
@section('content')
<section class="content-section">
    <div class="section-header"><h1>Modifier Contenu</h1></div>
    <div class="recent-activity">
        <form action="{{ url('/admin/recettes/' . $contenu->id_contenu . '/update') }}" method="POST">
            @csrf
            <div class="form-group"><label>Titre</label><input type="text" name="titre" value="{{ $contenu->titre ?? '' }}"></div>
            <div class="form-group"><label>Texte</label><textarea name="texte">{{ $contenu->texte ?? '' }}</textarea></div>
            <div class="form-group"><label>Statut</label><input type="text" name="statut" value="{{ $contenu->statut ?? '' }}"></div>
            <button class="btn btn-primary" type="submit">Enregistrer</button>
            <a href="{{ route('admin.contenu.index') }}" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
</section>
@endsection
