@extends('dashboard.layout')
@section('content')
<section class="content-section">
    <div class="section-header"><h1>Modifier Région</h1></div>
    <div class="recent-activity">
        <form action="{{ url('/admin/regions/' . $region->id_region . '/update') }}" method="POST">
            @csrf
            <div class="form-group"><label>Nom</label><input type="text" name="nom_region" value="{{ $region->nom_region ?? '' }}"></div>
            <div class="form-group"><label>Description</label><textarea name="description">{{ $region->description ?? '' }}</textarea></div>
            <div class="form-group"><label>Superficie</label><input type="text" name="superficie" value="{{ $region->superficie ?? '' }}"></div>
            <button class="btn btn-primary" type="submit">Enregistrer</button>
            <a href="{{ route('admin.regions.index') }}" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
</section>
@endsection
