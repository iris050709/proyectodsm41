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
        border-color: #0056b3;
    }
</style>

<div class="form-container">
    <h1>Agregar Autor</h1>

    <form action="{{ route('authors.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Nombre:</label>
            <input type="text" class="form-control" name="name" id="name" required>
        </div>
        
        <div class="form-group">
            <label for="bio">Biografía:</label>
            <textarea class="form-control" name="bio" id="bio"></textarea>
        </div>
        
        <div class="form-group">
            <label for="birth_date">Fecha de Nacimiento:</label>
            <input type="date" class="form-control" name="birth_date" id="birth_date">
        </div>
        
        <center><button type="submit" class="btn btn-primary">Guardar</button></center>
    </form>
</div>
@endsection
