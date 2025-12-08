@extends('dashboard.layout')

@section('content')
<section class="content-section">
    <div class="section-header">
        <h1>Ajouter une région</h1>
    </div>

    <div class="recent-activity">
        <form action="{{ route('admin.regions.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Nom</label>
                <input type="text" name="nom_region" value="{{ old('nom_region') }}">
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea name="description">{{ old('description') }}</textarea>
            </div>
            <div class="form-group">
                <label>Population</label>
                <input type="number" name="population" value="{{ old('population') }}">
            </div>
            <div class="form-actions">
                <button class="btn btn-primary" type="submit">Créer</button>
                <a href="{{ route('admin.regions.index') }}" class="btn btn-secondary">Annuler</a>
            </div>
        </form>
    </div>
</section>
@endsection
