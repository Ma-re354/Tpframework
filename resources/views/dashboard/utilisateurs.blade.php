@extends('dashboard.layout')

@section('content')
<section id="utilisateurs" class="content-section active">
    <div class="section-header">
        <h1>Gestion des Utilisateurs</h1>
        <a href="{{ route('admin.utilisateurs.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Ajouter un utilisateur
        </a>
    </div>
    <div class="section-search">
        <div class="search-filter">
            <i class="fas fa-search"></i>
            <input type="text" placeholder="Rechercher un utilisateur...">
        </div>
    </div>
    <div class="table-container">
        <table class="data-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Rôle</th>
                    <th>Date d'inscription</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users ?? [] as $user)
                <tr>
                    <td>#{{ str_pad($user->id_utilisateur, 3, '0', STR_PAD_LEFT) }}</td>
                    <td>{{ $user->nom }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if($user->id_role == 1)
                            <span class="badge badge-admin">Administrateur</span>
                        @elseif($user->id_role == 2)
                            <span class="badge badge-supervisor">Superviseur</span>
                        @elseif($user->id_role == 3)
                            <span class="badge badge-moderator">Contrôleur</span>
                        @else
                            <span class="badge badge-user">Utilisateur</span>
                        @endif
                    </td>
                    <td>{{ $user->date_inscription }}</td>
                    <td>
                        @if($user->statut == 'actif')
                            <span class="badge badge-success">Actif</span>
                        @else
                            <span class="badge badge-warning">Inactif</span>
                        @endif
                    </td>
                    <td class="actions">
                        <a href="{{ route('admin.utilisateurs.show', $user->id_utilisateur) }}" class="btn-icon btn-view btn-primary" title="Voir"><i class="fas fa-eye"></i></a>
                        <a href="{{ route('admin.utilisateurs.edit', $user->id_utilisateur) }}" class="btn-icon btn-edit" title="Modifier"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('admin.utilisateurs.destroy', $user->id_utilisateur) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-icon btn-delete" onclick="return confirm('Supprimer cet utilisateur ?')" title="Supprimer"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>
@endsection