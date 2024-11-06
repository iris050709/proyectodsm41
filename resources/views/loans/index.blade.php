@extends('layouts.app')

@section('content')
@include('sweetalert::alert')
    <h1>Préstamos</h1>
    <div class="text-center mb-3">
    <a href="{{ route('loans.create') }}" class="btn btn-primary">Agregar Nuevo Préstamo</a>
    </div><br>

    <table class="table">
        <thead>
            <tr>
                <th>Usuario</th>
                <th>Libro</th>
                <th>Fecha de Préstamo</th>
                <th>Fecha de Devolución</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($loans as $loan)
                <tr>
                    <td>{{ $loan->user->name }}</td>
                    <td>{{ $loan->book->title }}</td>
                    <td>{{ $loan->loan_date }}</td>
                    <td>{{ $loan->return_date }}</td>
                    <td>
                        <a href="{{ route('loans.show', $loan->id) }}" class="btn btn-info">Ver</a>
                        <a href="{{ route('loans.edit', $loan->id) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('loans.destroy', $loan->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este préstamo?');">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center mt-3">
        <div class="text-center">
            {{ $loans->links('pagination::bootstrap-4') }}
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