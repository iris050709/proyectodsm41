@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $genre->name }}</h1>
    <p><strong>Descripción:</strong> {{ $genre->description }}</p>

    <center><div class="d-flex justify-content-between">
        <a href="{{ route('genres.index') }}" class="btn btn-secondary">Volver a la Lista</a>
        <div><br>
            <a href="{{ route('genres.edit', $genre->id) }}" class="btn btn-warning">Editar</a><br><br>
            <form action="{{ route('genres.destroy', $genre->id) }}" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este género?');">Eliminar</button>
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
</style>
@endsection
