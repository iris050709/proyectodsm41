<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Formulario de Usuario</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #e9ecef; 
        }
        .card {
            border-radius: 10px; 
        }
        .card-header {
            background-color: #4a1a66;
            color: white;
        }
        h4 {
            color: #baa3e6; 
            font-weight: bold; 
        }
        .btn-primary {
            background-color: #5528a7; 
            border-color: #9472bb;
        }
        .btn-primary:hover {
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
            font-weight: bold; 
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header text-center">
                        <h4>Bienvenido</h4>
                    </div>
                    <div class="card-body">
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{$error}}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        
                        <form action="{{ route('user.store') }}" method="post" id="create_user_form">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="nombre">Nombre:</label>
                                <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Ingrese su nombre" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Correo:</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Ingrese su correo" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Contraseña:</label>
                                <input type="password" name="password" id="password" class="form-control" placeholder="Ingrese su contraseña" required>
                            </div>
                            <div class="form-group">
                                <input type="submit" value="Enviar" class="btn btn-primary btn-block">
                            </div>
                            <div class="form-group">
                                <a href="{{ route('login') }}" class="btn btn-secondary btn-block">Cancelar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $('#create_user_form').on('submit', function(event) {
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
                    success: function(response) {
                        console.log(response);
                        Swal.fire({
                            icon: 'success',
                            title: '¡Éxito!',
                            text: 'Usuario creado con éxito',
                            confirmButtonText: 'Aceptar'
                        }).then(function() {
                            window.location.href = "{{ route('user.list') }}";
                        });
                    },
                    error: function(error) {
                        console.log(error);
                        Swal.fire({
                            icon: 'error',
                            title: '¡Error!',
                            text: 'Hubo un error al crear el usuario. Intenta de nuevo.',
                            confirmButtonText: 'Aceptar'
                        });
                    }
                });
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
