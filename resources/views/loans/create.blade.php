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

    .btn-secondary {
        margin-left: 10px;
    }
</style>

<div class="form-container">
    <h1>Crear Préstamo</h1>

    <form action="{{ route('loans.store') }}" method="POST" id="create_loan_form">
        @csrf

        <div class="form-group">
            <label for="user_id">Usuario</label>
            <select name="user_id" id="user_id" class="form-control" required>
                <option value="">Seleccionar Usuario</option>
                @foreach($users as $us)
                    <option value="{{ $us->id }}">{{ $us->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="book_id">Libro</label>
            <select name="book_id" id="book_id" class="form-control" required>
                <option value="">Seleccionar Libro</option>
                @foreach($books as $book)
                    <option value="{{ $book->id }}">{{ $book->title }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="loan_date">Fecha de Préstamo</label>
            <input type="date" name="loan_date" id="loan_date" class="form-control" required>
        </div>
        
        <div class="form-group">
            <label for="return_date">Fecha de Devolución:</label>
            <input type="date" name="return_date" class="form-control" required>
        </div>

        <center><button type="submit" class="btn btn-primary">Crear Préstamo</button>
        <a href="{{ route('loans.index') }}" class="btn btn-secondary">Cancelar</a></center>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#create_loan_form').on('submit', function(event) {
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
                success: function(response) {
                    console.log(response);
                    alert('Prestamo creado con éxito');
                    window.location.href = "{{ route('loans.index') }}";
                },
                error: function(error) {
                    console.log(error);
                    alert('Hubo un error al crear el prestamo. Intenta de nuevo.');
                }
            });
        });
    });
</script>
@endsection
