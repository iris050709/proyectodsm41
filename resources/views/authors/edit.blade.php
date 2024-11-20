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
        background-color: #0069d9;
        border-color: #0062cc;
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
    <h1>Editar Autor</h1>

    <form action="{{ route('authors.update', $author->id) }}" method="POST" id="edit_author_form">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Nombre:</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $author->name }}" required>
        </div>
        
        <div class="form-group">
            <label for="bio">Biografía:</label>
            <textarea name="bio" id="bio" class="form-control">{{ $author->bio }}</textarea>
        </div>
        
        <div class="form-group">
            <label for="birth_date">Fecha de Nacimiento:</label>
            <input type="date" name="birth_date" id="birth_date" class="form-control" value="{{ $author->birth_date }}">
        </div>

        <center><button type="submit" class="btn btn-success">Actualizar</button>
        <a href="{{ route('authors.index') }}" class="btn btn-secondary">Cancelar</a></center>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function(){
        $('#edit_author_form').on('submit', function(event){
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
                    alert('Autor actualizado correctamente');
                    window.location.href = "{{ route('authors.index') }}"; 
                },
                error: function(error){
                    console.error(error);
                    alert('Ocurrió un error al actualizar el autor.');
                }
            });
        });
    });
</script>
@endsection
