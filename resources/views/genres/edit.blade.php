@extends('layouts.app')

@section('content')
<style>
    .form-container {
        max-width: 600px;
        margin: 20px auto;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 8px;
        background-color: #f9f9f9;
    }

    .form-container h1 {
        text-align: center;
        margin-bottom: 20px;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        font-weight: bold;
    }

    .btn-success {
        background-color: #28a745;
        border-color: #28a745;
    }

    .btn-success:hover {
        background-color: #218838;
        border-color: #1e7e34;
    }

    .btn-secondary {
        margin-left: 10px;
    }

    input, textarea {
        width: 100%;
    }
</style>

<div class="form-container">
    <h1>Editar Género</h1>

    <form action="{{ route('genres.update', $genre->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Nombre:</label>
            <input type="text" name="name" class="form-control" value="{{ $genre->name }}" required>
        </div>

        <div class="form-group">
            <label for="description">Descripción:</label>
            <textarea name="description" class="form-control">{{ $genre->description }}</textarea>
        </div>

        <center><button type="submit" class="btn btn-success">Actualizar</button>
        <a href="{{ route('genres.index') }}" class="btn btn-secondary">Cancelar</a></center>
    </form>
</div>
@endsection
