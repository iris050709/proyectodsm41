@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalles del Libro</h1>
    <p><strong>Título:</strong> {{ $book->title }}</p>
    <p><strong>Autor:</strong> {{ $book->author->name }}</p>
    <p><strong>Género:</strong> {{ $book->genre->name }}</p>
    <p><strong>Editorial:</strong> {{ $book->editorial->name }}</p>
    <p><strong>Año de Publicación:</strong> {{ $book->publication_year }}</p>
    <p><strong>Descripción:</strong> {{ $book->description }}</p>
    <p><strong>Stock:</strong> {{ $book->stock }}</p>

    <center><div class="d-flex justify-content-between">
        <a href="{{ route('books.index') }}" class="btn btn-secondary">Volver a la Lista</a>
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
