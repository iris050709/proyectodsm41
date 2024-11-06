@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalles del Préstamo</h1>

    <div class="mb-3">
        <p><strong>Usuario:</strong> {{ $loan->user->name }}</p>
        <p><strong>Libro:</strong> {{ $loan->book->title }}</p>
        <p><strong>Fecha de Préstamo:</strong> {{ \Carbon\Carbon::parse($loan->loan_date)->format('d/m/Y') }}</p>
        <p><strong>Fecha de Devolución:</strong> {{ \Carbon\Carbon::parse($loan->return_date)->format('d/m/Y') }}</p>
    </div>

    <center><div class="d-flex justify-content-between">
        <a href="{{ route('loans.index') }}" class="btn btn-secondary">Volver a la Lista</a>
        <div><br>
            <a href="{{ route('loans.edit', $loan->id) }}" class="btn btn-warning">Editar</a><br><br>
            <form action="{{ route('loans.destroy', $loan->id) }}" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este préstamo?');">Eliminar</button>
            </form>
        </div>
    </div></center>
</div>

<style>
    h1 {
        margin-bottom: 20px;
        text-align: center;
        color: #333;
    }

    .container {
        background-color: #f8f9fa;
        border-radius: 8px;
        padding: 20px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        border: 1px solid #dee2e6;
    }

    .btn-secondary {
        background-color: #bcdafa;
        border-color: #007bff;
    }

    .btn-warning {
        background-color: #ffc107;
        border-color: #ffc107;
    }

    .btn-danger {
        background-color: #dc3545;
        border-color: #dc3545;
    }
</style>
@endsection
