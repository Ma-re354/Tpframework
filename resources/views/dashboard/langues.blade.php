@extends('dashboard.layout')

@section('content')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<section id="utilisateurs" class="content-section active">
    <div class="section-header">
        <h1>Gestion des Utilisateurs</h1>
        <a href="{{ route('admin.langues.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Ajouter une langue
        </a>
    </div>
    <div class="section-search">
        <div class="search-filter">
            <i class="fas fa-search"></i>
            <input type="text" placeholder="Rechercher un utilisateur...">
        </div>
    </div>
    <div class="table-container">
        <table class="data-table" id="languesTable" class="table table-bordered table-striped display" style="width:100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom langue</th>
                    <th>Code langue</th>
                    
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach( $langues ?? [] as  $langue)
                <tr>
                    <td>#{{ str_pad($langue->id_langue, 3, '0', STR_PAD_LEFT) }}</td>
                    <td>{{ $langue->nom_langue }}</td>
                    <td>{{ $langue->code_langue }}</td>
                   
                    
                    <td>{{ Illuminate\Support\Str::words($langue->description  ?? '—', 15, '...') }}</td>
                    <td class="actions">
                        <a href="{{ route('admin.langues.show', $langue->id_langue) }}" class="btn-icon btn-view btn-primary" title="Voir"><i class="fas fa-eye"></i></a>
                        <a href="{{ route('admin.langues.edit', $langue->id_langue) }}" class="btn-icon btn-edit" title="Modifier"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('admin.langues.destroy', $langue->id_langue) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-icon btn-delete" onclick="return confirm('Supprimer cette langue ?')" title="Supprimer"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
        // Vérifie si la table existe
        var table = document.getElementById('languesTable');
        if (table) {
            // Initialisation de DataTable avec des options de base
            var dataTable = $(table).DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/fr-FR.json"
                },
                "dom": '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>' +
                       '<"row"<"col-sm-12"tr>>' +
                       '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
                "initComplete": function() {
                    // Personnalisation du champ de recherche
                    $('.dataTables_filter').addClass('float-end mb-3');
                    $('.dataTables_filter input')
                        .addClass('form-control form-control-sm')
                        .attr('placeholder', 'Rechercher...');
                    
                    // Personnalisation de la pagination
                    $('.dataTables_paginate').addClass('float-end');
                    
                    // Affiche un message de débogage dans la console
                    console.log('DataTable initialisée avec succès');
                }
            });
            
            // Vérifie si DataTable a été correctement initialisée
            if ($.fn.DataTable.isDataTable(table)) {
                console.log('La table est bien une DataTable');
            }
        } else {
            console.error('La table avec l\'ID "languesTable" n\'a pas été trouvée');
        }
    });
    </script>
@endsection