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
    <h1>Editar Libro</h1>

    <form action="{{ route('books.update', $book->id) }}" method="POST" id="edit_book_form">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">Título:</label>
            <input type="text" name="title" class="form-control" value="{{ $book->title }}" required>
        </div>

        <div class="form-group">
            <label for="author_id">Autor:</label>
            <select name="author_id" class="form-control" required>
                @foreach($authors as $author)
                    <option value="{{ $author->id }}" {{ $author->id == $book->author_id ? 'selected' : '' }}>{{ $author->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="genre_id">Género:</label>
            <select name="genre_id" class="form-control" required>
                @foreach($genres as $genre)
                    <option value="{{ $genre->id }}" {{ $genre->id == $book->genre_id ? 'selected' : '' }}>{{ $genre->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="editorial_id">Editorial:</label>
            <select name="editorial_id" class="form-control" required>
                @foreach($editorials as $editorial)
                    <option value="{{ $editorial->id }}" {{ $editorial->id == $book->editorial_id ? 'selected' : '' }}>{{ $editorial->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="publication_year">Año de Publicación:</label>
            <input type="number" name="publication_year" class="form-control" value="{{ $book->publication_year }}" required min="1900" max="{{ date('Y') }}">
        </div>

        <div class="form-group">
            <label for="description">Descripción:</label>
            <textarea name="description" class="form-control">{{ $book->description }}</textarea>
        </div>

        <div class="form-group">
            <label for="stock">Stock:</label>
            <input type="number" name="stock" class="form-control" value="{{ $book->stock }}" required min="0">
        </div>

        <center><button type="submit" class="btn btn-success">Actualizar</button>
        <a href="{{ route('books.index') }}" class="btn btn-secondary">Cancelar</a></center>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function(){
        $('#edit_book_form').on('submit', function(event){
            event.preventDefault(); 
            alert('ENVIO DE FORMULARIO');
            let data = $(this).serialize(); 
            console.log(data);
            let url = $(this).attr('action'); 
            console.log(url);
            data += '&_method=PUT';
            $.ajax({
                type: 'POST',
                url: url,
                data: data,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
                },
                success: function(response){
                    console.log(response);
                    alert('Libro actualizado correctamente');
                    window.location.href = "{{ route('books.index') }}"; 
                },
                error: function(error){
                    console.error(error);
                    alert('Ocurrió un error al actualizar el libro.');
                }
            });
        });
    });
</script>

@endsection
