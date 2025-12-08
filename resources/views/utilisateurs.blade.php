@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Gestion des Utilisateurs</h1>
        <button class="btn btn-primary"><i class="fas fa-plus me-2"></i>Nouvel Utilisateur</button>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Liste des Utilisateurs</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
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
                        <tr>
                            <td>#001</td>
                            <td>Jean Dupont</td>
                            <td>jean.dupont@email.com</td>
                            <td><span class="badge badge-primary">Administrateur</span></td>
                            <td>15/01/2023</td>
                            <td><span class="badge badge-success">Actif</span></td>
                            <td>
                                <button class="btn btn-action btn-view" title="Voir">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="btn btn-action btn-edit" title="Modifier">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-action btn-delete" title="Supprimer">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>#002</td>
                            <td>Marie Martin</td>
                            <td>marie.martin@email.com</td>
                            <td><span class="badge badge-secondary">Utilisateur</span></td>
                            <td>20/02/2023</td>
                            <td><span class="badge badge-success">Actif</span></td>
                            <td>
                                <button class="btn btn-action btn-view" title="Voir">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="btn btn-action btn-edit" title="Modifier">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-action btn-delete" title="Supprimer">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>#003</td>
                            <td>Pierre Durand</td>
                            <td>pierre.durand@email.com</td>
                            <td><span class="badge badge-secondary">Utilisateur</span></td>
                            <td>10/03/2023</td>
                            <td><span class="badge badge-danger">Inactif</span></td>
                            <td>
                                <button class="btn btn-action btn-view" title="Voir">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="btn btn-action btn-edit" title="Modifier">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-action btn-delete" title="Supprimer">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection