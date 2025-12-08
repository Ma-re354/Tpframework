@extends('dashboard.layout')

@section('content')
<section class="content-section">
    <div class="section-header"><h1>Modifier langue</h1></div>
    <div class="recent-activity">
        <form action="{{ route('admin.langues.update', $langue->id_langue) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Nom</label>
                <input type="text" name="nom_langue" value="{{ $langue->nom_langue }}">
            </div>

            <div class="form-group">
                <label>Code</label>
                <input type="text" name="code_langue" value="{{ $langue->code_langue }}">
            </div>

            <div class="form-group">
                <label>Description</label>
                <textarea name="description">{{ $langue->description }}</textarea>
            </div>

            <button class="btn btn-primary" type="submit">Enregistrer</button>

            <a href="{{ route('admin.langues.index') }}" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
</section>
@endsection