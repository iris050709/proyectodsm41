@extends('layouts.app')

@section('content')
@include('sweetalert::alert')
<h1>Editoriales</h1>
<div class="text-center mb-3">
<a href="{{ route('editorials.create') }}" class="btn btn-primary">Agregar Editorial</a>
</div>
<table class="table mt-3">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Dirección</th>
            <th>Teléfono</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($editorials as $editorial)
        <tr>
            <td>{{ $editorial->name }}</td>
            <td>{{ $editorial->address }}</td>
            <td>{{ $editorial->phone }}</td>
            <td>
                <a href="{{ route('editorials.show', $editorial->id) }}" class="btn btn-info">Ver</a>
                <a href="{{ route('editorials.edit', $editorial->id) }}" class="btn btn-warning">Editar</a>
                <form action="{{ route('editorials.destroy', $editorial->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="d-flex justify-content-center mt-3">
    <div class="text-center">
        {{ $editorials->links('pagination::bootstrap-4') }}
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
