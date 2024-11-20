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

    <form action="{{ route('genres.update', $genre->id) }}" method="POST" id="edit_genre_form">
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
<script>
    $(document).ready(function(){
        $('#edit_genre_form').on('submit', function(event){
            event.preventDefault();
            alert('ENVIO DE FORMULARIO');
            var data = $(this).serialize();
            console.log(data);
            var url = $(this).attr('action');
            console.log(url);
            $.ajax({
                type: 'POST',
                url: url,
                data: data,
                success: function(response){
                    console.log(response);
                },
                error: function(error){
                    console.log(error);
                }
            });
        });
    });
</script>
@endsection
