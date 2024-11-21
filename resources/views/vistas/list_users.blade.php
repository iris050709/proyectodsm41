@extends('layouts.app')
@section('title', 'Listado de usuarios')
@section('styles')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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
        .btn-primary, .btn-success {
            background-color: #6f42c1;
            border: none;
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

@section('content')
@include('sweetalert::alert')

<div class="container mt-5">
    <h1>Listado de Usuarios</h1>

    <div class="text-center mb-3">
        <a href="{{ route('user.create') }}" class="btn btn-primary mb-3"><i class="fas fa-plus"></i> Agregar Usuario</a>
    </div>

    <div class="table-container">
        <table class="table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($usuarios as $usuario)
                <tr>
                    <td>{{ $usuario->name }}</td>
                    <td>
                        <a href="{{ route('user.update', $usuario->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Editar</a>
                        <a href="{{ route('user.destroy', $usuario->id) }}" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Eliminar</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center mt-3">
        <div class="text-center">
            {{ $usuarios->links('pagination::bootstrap-4') }}
        </div>
    </div>
</div>
@endsection
