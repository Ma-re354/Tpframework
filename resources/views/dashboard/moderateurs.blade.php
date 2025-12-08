@extends('dashboard.layout')

@section('content')
<section id="moderateurs" class="content-section active">
    <div class="section-header">
        <h1>Gestion des Modérateurs</h1>
        <button class="btn btn-primary">
            <i class="fas fa-plus"></i> Ajouter un modérateur
        </button>
    </div>
    <div class="section-search">
        <div class="search-filter">
            <i class="fas fa-search"></i>
            <input type="text" placeholder="Rechercher un modérateur...">
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
                    <th>Date d'ajout</th>
                    <th>Permissions</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($moderators ?? [] as $moderator)
                <tr>
                    <td>#M{{ str_pad($moderator->id, 3, '0', STR_PAD_LEFT) }}</td>
                    <td>{{ $moderator->name }}</td>
                    <td>{{ $moderator->email }}</td>
                    <td><span class="badge badge-moderator">Modérateur</span></td>
                    <td>{{ $moderator->created_at->format('d/m/Y') }}</td>
                    <td>{{ $moderator->permissions }}</td>
                    <td class="actions">
                        <button class="btn-icon btn-view"><i class="fas fa-eye"></i></button>
                        <button class="btn-icon btn-edit"><i class="fas fa-edit"></i></button>
                        <button class="btn-icon btn-delete"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>
@endsection