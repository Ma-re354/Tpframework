@extends('dashboard.layout')

@section('content')
<section id="regions" class="content-section active">
    <div class="section-header">
        <h1>Gestion des Régions</h1>
        <a href="{{ route('admin.regions.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Ajouter une région
        </a>
    </div>

    <div class="section-search">
        <div class="search-filter">
            <i class="fas fa-search"></i>
            <input type="text" placeholder="Rechercher une région...">
        </div>
    </div>

    <!-- Tableau des régions (inséré avant les cartes) -->
    <div class="recent-activity" style="margin-top: 30px;">
        
        <div class="table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom Région</th>
                        <th>Description</th>
                        <th>Superficie</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if(!empty($regions) && count($regions))
                        @foreach($regions as $region)
                        <tr>
                            <td>#{{ $region->id_region ?? '—' }}</td>
                            <td>{{ $region->nom_region ?? $region->name ?? '—' }}</td>
                           <td>{{ Illuminate\Support\Str::words($region->description ?? '—', 15, '...') }}</td>
                            <td>{{ $region->superficie ?? '—' }}</td>
                            <td class="actions">
                                <a href="{{ route('admin.regions.show', $region->id_region) }}" class="btn-icon btn-view" title="Voir"><i class="fas fa-eye"></i></a>
                                <a href="{{ route('admin.regions.edit', $region->id_region) }}" class="btn-icon btn-edit" title="Modifier"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('admin.regions.destroy', $region->id_region) }}" method="POST" style="display:inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-icon btn-delete" onclick="return confirm('Supprimer cette région ?')" title="Supprimer"><i class="fas fa-trash"></i></button>
                                    </form>
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <!-- Exemples statiques si aucune donnée fournie -->
                        <tr>
                            <td>#001</td>
                            <td>Île-de-France</td>
                            <td>Région comprenant Paris et sa couronne.</td>
                            <td>12,012 km²</td>
                            <td class="actions">
                                <button class="btn-icon btn-view"><i class="fas fa-eye"></i></button>
                                <button class="btn-icon btn-edit"><i class="fas fa-edit"></i></button>
                                <button class="btn-icon btn-delete"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>#002</td>
                            <td>Provence-Alpes-Côte d'Azur</td>
                            <td>Région du sud-est, bordée par la mer Méditerranée.</td>
                            <td>31,400 km²</td>
                            <td class="actions">
                                <button class="btn-icon btn-view"><i class="fas fa-eye"></i></button>
                                <button class="btn-icon btn-edit"><i class="fas fa-edit"></i></button>
                                <button class="btn-icon btn-delete"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

   
    <!-- Statistiques des régions -->
   

  

    
</section>
@endsection
