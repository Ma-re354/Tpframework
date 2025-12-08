@extends('dashboard.layout')

@section('content')
<section class="content-section">
    <div class="section-header">
        <h1>Détails langue</h1>
    </div>

    <div class="recent-activity">
        <form>
            <div class="form-group"><label>Nom</label><input value="{{ $langue->nom_langue ?? '' }}" readonly></div>
            <div class="form-group"><label>Code</label><input value="{{ $langue->code_langue ?? '' }}" readonly></div>
            <div class="form-group"><label>Description</label><textarea readonly>{{ $langue->description ?? '' }}</textarea></div>
            <a href="{{ route('admin.langues.edit', $langue->id_langue) }}" class="btn btn-primary">Modifier</a>
            <a href="{{ route('admin.langues.index') }}" class="btn btn-secondary">Retour</a>
        </form>
    </div>
</section>
@endsection
