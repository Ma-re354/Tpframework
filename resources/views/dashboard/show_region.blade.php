@extends('dashboard.layout')
@section('content')
<section class="content-section">
    <div class="section-header"><h1>Détails Région</h1></div>
    <div class="recent-activity">
        <div class="form-group"><label>Nom</label><input value="{{ $region->nom_region ?? '' }}" readonly></div>
        <div class="form-group"><label>Description</label><textarea readonly>{{ $region->description ?? '' }}</textarea></div>
        <div class="form-group"><label>Superficie</label><input value="{{ $region->superficie ?? '' }}" readonly></div>
        <a href="{{ route('admin.regions.edit', $region->id_region) }}" class="btn btn-primary">Modifier</a>
        <a href="{{ route('admin.regions.index') }}" class="btn btn-secondary">Retour</a>
    </div>
</section>
@endsection
