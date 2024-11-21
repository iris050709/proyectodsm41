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
</style>

<div class="form-container">
    <h1>Agregar Nuevo Género</h1>

    <form action="{{ route('genres.store') }}" method="POST" id="create_genre_form">
        @csrf
        <div class="form-group">
            <label for="name">Nombre:</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="description">Descripción:</label>
            <textarea name="description" class="form-control"></textarea>
        </div>
        <center><button type="submit" class="btn btn-success">Crear</button>
        <a href="{{ route('genres.index') }}" class="btn btn-secondary">Cancelar</a></center>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('#create_genre_form').on('submit', function (event) {
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
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    console.log(response);
                    alert('Genero creado exitosamente');
                    window.location.href = "{{ route('genres.index') }}"; 
                },
                error: function (xhr) {
                    console.error(xhr);
                    alert('Hubo un error al guardar el genero. Intenta de nuevo.');
                }
            });
        });
    });
</script>
@endsection
