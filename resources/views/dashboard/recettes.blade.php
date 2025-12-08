@extends('dashboard.layout')
@section('content')
<section id="recettes" class="content-section">
    <div class="section-header">
        <h1>Gestion des Recettes</h1>
        <a href="{{ route('admin.contenu.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Ajouter une recette
        </a>
    </div>
    <div class="section-search">
        <div class="search-filter">
            <i class="fas fa-search"></i>
            <input type="text" placeholder="Rechercher une recette...">
        </div>
    </div>
    <div class="table-container">
        <table class="data-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titre</th>
                    <th>Texte</th>
                    <th>Langue</th>
                    <th>Auteur</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($contenues ?? [] as $contenu)
                <tr>
                    <td>#{{ str_pad($contenu->id_contenu, 3, '0', STR_PAD_LEFT) }}</td>
                    <td>{{ $contenu->titre }}</td>
                    <td>{{ Illuminate\Support\Str::limit(strip_tags($contenu->texte ?? ''), 100) }}</td>
                    <td>{{ $contenu->langue->nom_langue ?? '—' }}</td>
                    <td>{{ optional($contenu->auteur)->nom ?? ('#' . ($contenu->id_auteur ?? '—')) }}</td>
                    <td class="actions">
                        <a href="{{ route('admin.contenu.show', $contenu->id_contenu) }}" class="btn-icon btn-view" title="Voir"><i class="fas fa-eye"></i></a>
                        <a href="{{ route('admin.contenu.edit', $contenu->id_contenu) }}" class="btn-icon btn-edit" title="Modifier"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('admin.contenu.destroy', $contenu->id_contenu) }}" method="POST" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-icon btn-delete" onclick="return confirm('Supprimer cette recette ?')" title="Supprimer"><i class="fas fa-trash"></i></button>
                            </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6">Aucun contenu trouvé.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</section>
@endsection