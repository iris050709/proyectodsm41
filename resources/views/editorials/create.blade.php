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
</style>

<div class="form-container">
    <h1>Agregar Editorial</h1>
    <form action="{{ route('editorials.store') }}" method="POST" id="create_editorial_form">
        @csrf
        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="address">Dirección</label>
            <input type="text" class="form-control" id="address" name="address">
        </div>
        <div class="form-group">
            <label for="phone">Teléfono</label>
            <input type="text" class="form-control" id="phone" name="phone">
        </div>
        <center>
            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="{{ route('editorials.index') }}" class="btn btn-secondary">Cancelar</a>
        </center>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('#create_editorial_form').on('submit', function (event) {
            event.preventDefault(); 
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
                    Swal.fire({
                        icon: 'success',
                        title: '¡Éxito!',
                        text: 'Editorial creada exitosamente',
                        confirmButtonText: 'Aceptar'
                    }).then(function() {
                        window.location.href = "{{ route('editorials.index') }}";
                    });
                },
                error: function (xhr) {
                    console.error(xhr);
                    Swal.fire({
                        icon: 'error',
                        title: '¡Error!',
                        text: 'Hubo un error al guardar la editorial. Intenta de nuevo.',
                        confirmButtonText: 'Aceptar'
                    });
                }
            });
        });
    });
</script>
@endsection
