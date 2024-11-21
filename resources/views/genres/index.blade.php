@extends('layouts.app')

@section('content')
@include('sweetalert::alert')
    <h1>Géneros</h1>
    <div class="text-center mb-3">
    <a href="{{ route('genres.create') }}" class="btn btn-primary">Agregar Nuevo Género</a>
    </div><br>
    
    <table class="table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($genres as $genre)
                <tr>
                    <td>{{ $genre->name }}</td>
                    <td>{{ $genre->description }}</td>
                    <td>
                        <a href="{{ route('genres.show', $genre->id) }}" class="btn btn-info">Ver</a>
                        <a href="{{ route('genres.edit', $genre->id) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('genres.destroy', $genre->id) }}" method="POST" style="display: inline;" class="genre_eliminar">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este género?');">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center mt-3">
        <div class="text-center">
            {{ $genres->links('pagination::bootstrap-4') }}
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function(){
        $('.genre_eliminar').on('submit', function(event){
            event.preventDefault(); 
            var form = $(this); 
            var url = form.attr('action');  
            console.log(url);
            var data = form.serialize(); 
            console.log(data); 

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
                        text: 'Genero eliminado correctamente',
                        confirmButtonText: 'Aceptar'
                    }).then(function() {
                        window.location.href = "{{ route('genres.index') }}";
                    });
                },
                error: function(error) {
                    Swal.fire({
                        icon: 'error',
                        title: '¡Error!',
                        text: 'Ocurrió un error al eliminar el genero. Intenta de nuevo.',
                        confirmButtonText: 'Aceptar'
                    });
                }
            });
        });
    });
</script>
    <style>
        body {
            background-color: #f8f9fa;
        }
        h1 {
            color: #6f42c1;
            text-align: center;
            margin-bottom: 30px;
        }
        .table-container {
            margin: 0 auto;
            width: 95%;
        }
        .table {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
        }
        .table th, .table td {
            text-align: center;
        }
        .table th {
            background-color: #6f42c1;
            color: #ffffff;
        }
        .btn-primary {
            background-color: #6f42c1;
            border: none;
        }
        .btn-info {
            background-color: #17a2b8;
        }
        .btn-warning {
            background-color: #ffc107;
        }
        .btn-danger {
            background-color: #dc3545;
        }
        .btn:hover {
            opacity: 0.8;
        }
        .pagination {
            justify-content: center;
        }
        .pagination .page-link {
            border-radius: 5px;
            margin: 0 5px;
        }
        .pagination .page-item.active .page-link {
            background-color: #6f42c1;
            color: #ffffff;
        }
        .pagination .page-link:hover {
            background-color: #6f42c1;
            color: #ffffff;
        }
    
    </style>
@endsection
