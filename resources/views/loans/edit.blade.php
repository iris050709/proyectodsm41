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

    input, select {
        width: 100%;
    }
</style>

<div class="form-container">
    <h1>Editar Préstamo</h1>

    <form action="{{ route('loans.update', $loan->id) }}" method="POST" id="edit_loan_form">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="user_id">Usuario:</label>
            <select name="user_id" id="user_id" class="form-control" required>
                <option value="">Seleccionar Usuario</option>
                @foreach($users as $us)
                    <option value="{{ $us->id }}" {{ $us->id == $loan->user_id ? 'selected' : '' }}>{{ $us->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="book_id">Libro:</label>
            <select name="book_id" id="book_id" class="form-control" required>
                @foreach($books as $book)
                    <option value="{{ $book->id }}" {{ $book->id == $loan->book_id ? 'selected' : '' }}>{{ $book->title }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="loan_date">Fecha de Préstamo:</label>
            <input type="date" name="loan_date" id="loan_date" class="form-control" value="{{ $loan->loan_date }}" required>
        </div>

        <div class="form-group">
            <label for="return_date">Fecha de Devolución:</label>
            <input type="date" name="return_date" class="form-control" value="{{ $loan->return_date }}" required>
        </div>

        <center><button type="submit" class="btn btn-success">Actualizar</button>
        <a href="{{ route('loans.index') }}" class="btn btn-secondary">Cancelar</a></center>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function(){
        $('#edit_loan_form').on('submit', function(event){
            event.preventDefault(); 
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
                success: function(response) {
                    console.log(response);
                    Swal.fire({
                        icon: 'success',
                        title: '¡Éxito!',
                        text: 'Préstamo actualizado correctamente',
                        confirmButtonText: 'Aceptar'
                    }).then(function() {
                        window.location.href = "{{ route('loans.index') }}";
                    });
                },
                error: function(error) {
                    console.error(error);
                    Swal.fire({
                        icon: 'error',
                        title: '¡Error!',
                        text: 'Ocurrió un error al actualizar el préstamo.',
                        confirmButtonText: 'Aceptar'
                    });
                }
            });
        });
    });
</script>
@endsection
