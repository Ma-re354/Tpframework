@extends('dashboard.layout')

@section('content')
<section id="histoires" class="content-section">
    <div class="section-header">
        <h1>Gestion des Histoires/Contes</h1>
        <button class="btn btn-primary">
            <i class="fas fa-plus"></i> Ajouter une histoire
        </button>
    </div>
    <div class="section-search">
        <div class="search-filter">
            <i class="fas fa-search"></i>
            <input type="text" placeholder="Rechercher une histoire...">
        </div>
    </div>
    <div class="table-container">
        <table class="data-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titre</th>
                    <th>Type</th>
                    <th>Auteur</th>
                    <th>Date de création</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>#H001</td>
                    <td>Le Petit Chaperon Rouge</td>
                    <td>Conte</td>
                    <td>Pierre Leroy</td>
                    <td>05/04/2023</td>
                    <td><span class="badge badge-success">Publié</span></td>
                    <td class="actions">
                        <button class="btn-icon btn-view"><i class="fas fa-eye"></i></button>
                        <button class="btn-icon btn-edit"><i class="fas fa-edit"></i></button>
                        <button class="btn-icon btn-delete"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
                <tr>
                    <td>#H002</td>
                    <td>Histoire de la Révolution</td>
                    <td>Histoire</td>
                    <td>Jean Dupont</td>
                    <td>22/05/2023</td>
                    <td><span class="badge badge-warning">Brouillon</span></td>
                    <td class="actions">
                        <button class="btn-icon btn-view"><i class="fas fa-eye"></i></button>
                        <button class="btn-icon btn-edit"><i class="fas fa-edit"></i></button>
                        <button class="btn-icon btn-delete"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</section>
@endsection