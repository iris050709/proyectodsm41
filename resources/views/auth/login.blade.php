@extends('layouts.app')

@section('content')
<div class="form-container">
    <h1>Iniciar Sesión</h1>
    <form id="login_form" action="{{ route('login') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="email">Correo Electrónico:</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>
        
        <div class="form-group">
            <label for="password">Contraseña:</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>
        
        <button type="submit" class="btn btn-primary btn-block">Iniciar Sesión</button>
    </form>

    <div class="text-center mt-3">
        <p>¿No tienes una cuenta? <a href="{{ route('user.create') }}">Regístrate aquí</a></p>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function(){
        $('#login_form').on('submit', function(event){
            event.preventDefault(); 
            alert('VERIFICAR DATOS');
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
                success: function(response){
                    console.log(response);
                    alert('Usuario correcto');
                    window.location.href = "{{ route('home') }}"; 
                },
                error: function(error){
                    console.error(error);
                    alert('Ocurrió un error al encontrar el usuario.');
                }
            });
        });
    });
</script>
<style>
    .form-container {
        max-width: 400px;
        margin: 50px auto;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 8px;
        background-color: #f9f9f9;
    }

    .form-container h1 {
        text-align: center;
        margin-bottom: 20px;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }

    .text-center {
        text-align: center;
    }
</style>
@endsection
