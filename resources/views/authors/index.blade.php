@extends('layouts.app')

@section('content')
@include('sweetalert::alert')

<div class="container">
    <h1>Autores</h1>
    <div class="text-center mb-3">
        <a href="{{ route('authors.create') }}" class="btn btn-primary mb-3">Agregar Autor</a>
    </div>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Biografía</th>
                <th>Fecha de Nacimiento</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($authors as $author)
            <tr>
                <td>{{ $author->name }}</td>
                <td>{{ $author->bio }}</td>
                <td>{{ $author->birth_date ? \Carbon\Carbon::parse($author->birth_date)->format('d/m/Y') : 'N/A' }}</td>
                <td>
                    <a href="{{ route('authors.show', $author->id) }}" class="btn btn-info">Ver</a>
                    <a href="{{ route('authors.edit', $author->id) }}" class="btn btn-warning">Editar</a>
                    <form action="{{ route('authors.destroy', $author->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este autor?');">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-center mt-3">
        <div class="text-center">
            {{ $authors->links('pagination::bootstrap-4') }}
        </div>
    </div>
</div>

<style>
    body {
        background-color: #f8f9fa;
    }
    h1 {
        color: #6f42c1;
        text-align: center;
        margin-bottom: 30px;
    }
    .table-container {
        margin: 0 auto;
        width: 95%;
    }
    .table {
        background-color: #ffffff;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        width: 100%;
    }
    .table th, .table td {
        text-align: center;
    }
    .table th {
        background-color: #6f42c1;
        color: #ffffff;
    }
    .btn-primary {
        background-color: #6f42c1;
        border: none;
    }
    .btn-info {
        background-color: #17a2b8;
    }
    .btn-warning {
        background-color: #ffc107;
    }
    .btn-danger {
        background-color: #dc3545;
    }
    .btn:hover {
        opacity: 0.8;
    }
    .pagination {
        justify-content: center;
    }
    .pagination .page-link {
        border-radius: 5px;
        margin: 0 5px;
    }
    .pagination .page-item.active .page-link {
        background-color: #6f42c1;
        color: #ffffff;
    }
    .pagination .page-link:hover {
        background-color: #6f42c1;
        color: #ffffff;
    }

</style>
@endsection
