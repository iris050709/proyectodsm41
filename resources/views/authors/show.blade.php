@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $author->name }}</h1>
    <p><strong>Biografía:</strong> {{ $author->bio }}</p>
    <p><strong>Fecha de Nacimiento:</strong> {{ $author->birth_date ? \Carbon\Carbon::parse($author->birth_date)->format('d/m/Y') : 'N/A' }}</p>

    <center><div class="d-flex justify-content-between">
        <a href="{{ route('authors.index') }}" class="btn btn-secondary">Volver a la Lista</a><br><br>
        <a href="{{ route('authors.edit', $author->id) }}" class="btn btn-warning">Editar</a><br><br>
        <form action="{{ route('authors.destroy', $author->id) }}" method="POST" style="display: inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este autor?');">Eliminar</button>
        </form>
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
</style>
@endsection
