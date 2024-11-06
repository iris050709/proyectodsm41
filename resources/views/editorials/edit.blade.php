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

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #004085;
    }

    input {
        width: 100%;
    }
</style>

<div class="form-container">
    <h1>Editar Editorial: {{ $editorial->name }}</h1>

    <form action="{{ route('editorials.update', $editorial->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $editorial->name }}" required>
        </div>

        <div class="form-group">
            <label for="address">Dirección</label>
            <input type="text" class="form-control" id="address" name="address" value="{{ $editorial->address }}">
        </div>

        <div class="form-group">
            <label for="phone">Teléfono</label>
            <input type="text" class="form-control" id="phone" name="phone" value="{{ $editorial->phone }}">
        </div>

        <center><button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('editorials.index') }}" class="btn btn-secondary">Cancelar</a></center>
    </form>
</div>
@endsection
