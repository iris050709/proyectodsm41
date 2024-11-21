@extends('layouts.app')

@section('title', 'Actualizar Usuario')

@section('styles')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            background-color: #e9ecef; 
        }
        h4 {
            color: #6f42c1; 
            font-weight: bold; 
            font-size: 2rem; 
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); 
        }
        .btn-success {
            background-color: #5528a7; 
            border-color: #9472bb;
        }
        .btn-success:hover {
            background-color: #b92b83; 
            border-color: #db73bc; 
        }
        .btn-secondary {
            background-color: #6c757d; 
            border-color: #6c757d;
        }
        .btn-secondary:hover {
            background-color: #5a6268; 
            border-color: #545b62; 
        }
        .form-group{
            font-size: 1.5rem;
        }
        .form-control{
            font-size:1.5rem;
        }
    </style>
@endsection

@section('content')
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header text-center">
                <h4 class="mb-0">Actualizar Usuario</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('user.update.data') }}" method="post" id="edit_user_form">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{ $usuario->id }}">
                    
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" name="nombre" value="{{ $usuario->name }}" class="form-control" id="nombre" placeholder="Ingresa tu nombre" required>
                    </div>

                    <div class="form-group text-center">
                        <input type="submit" value="Actualizar" class="btn btn-success btn-lg">
                        <a href="{{ route('user.list') }}" class="btn btn-secondary btn-lg">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function(){
        $('#edit_user_form').on('submit', function(event){
            event.preventDefault(); 
            let data = $(this).serialize(); 
            console.log(data);
            let url = $(this).attr('action'); 
            console.log(url);
            $.ajax({
                type: 'POST',
                url: url,
                data: data,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
                },
                success: function(response) {
                    console.log(response);
                    Swal.fire({
                        icon: 'success',
                        title: '¡Éxito!',
                        text: 'Usuario actualizado correctamente',
                        confirmButtonText: 'Aceptar'
                    }).then(function() {
                        window.location.href = "{{ route('user.list') }}";
                    });
                },
                error: function(error) {
                    console.error(error);
                    Swal.fire({
                        icon: 'error',
                        title: '¡Error!',
                        text: 'Ocurrió un error al actualizar el usuario.',
                        confirmButtonText: 'Aceptar'
                    });
                }
            });
        });
    });
</script>
@endsection
