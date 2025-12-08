@extends('dashboard.layout')

@section('content')
<section class="content-section">
    <div class="section-header">
        <h1>Ajouter une langue</h1>
    </div>

    <div class="recent-activity">
        <form action="{{ route('admin.langues.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Nom</label>
                <input type="text" name="nom_langue" value="{{ old('nom_langue') }}">
            </div>
            <div class="form-group">
                <label>Code</label>
                <input type="text" name="code_langue" value="{{ old('code_langue') }}">
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea name="description">{{ old('description') }}</textarea>
            </div>

            <div class="form-actions">
                <button class="btn btn-primary" type="submit">Créer</button>
                <a href="{{ route('admin.langues.index') }}" class="btn btn-secondary">Annuler</a>
            </div>
        </form>
    </div>
</section>
@endsection
