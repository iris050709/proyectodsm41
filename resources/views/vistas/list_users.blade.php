@extends('layouts.app')
@section('title', 'Listado de usuarios')
@section('styles')
    <link rel="stylesheet" href="hola.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            background-color: #e9ecef; 
        }
        h1 {
            font-size: 2.5rem; 
            color: #6f42c1; 
            font-weight: bold; 
        }
        .table {
            border-radius: 10px;
            overflow: hidden;
            font-size: 1.5rem;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /
        }
        .table thead th {
            background-color: #6f42c1; 
            color: white;
            font-weight: bold;
        }
        .table tbody tr:nth-child(odd) {
            background-color: #ecd5f1; 
        }
        .table tbody tr{
            background-color: #d5d5f1; 
        }
        .table tbody tr:hover {
            background-color: #97bafc; 
        }
        .btn-success {
            background-color: #5528a7; 
            border-color: #9472bb;
        }
        .btn-success:hover {
            background-color: #b92b83; 
            border-color: #db73bc; 
        }
        .btn-primary {
            background-color: #5528a7; 
            border-color: #9472bb;
        }
        .btn-primary:hover {
            background-color: #b92b83; 
            border-color: #db73bc; 
        }
        .btn-danger {
            background-color: #5528a7; 
            border-color: #9472bb;
        }
        .btn-danger:hover {
            background-color: #b92b83; 
            border-color: #db73bc; 
        }
        .btn {
            font-size: 1.5rem;
        }
        .pagination {
            margin-top: 20px; 
        }
        .pagination .page-item .page-link {
            font-size: 1.2rem; 
            padding: 10px 15px; 
            color: #db98d2; 
        }
        .pagination .page-item.active .page-link {
            background-color: #5528a7; 
            border-color: #9472bb;
        }
        .pagination .page-item.active .page-link:hover {
            background-color: #b92b83; 
            border-color: #db73bc; 
        }
    </style>
@endsection

@section('content')
@include('sweetalert::alert')
<div class="container mt-5">
    <h1 class="text-center mb-4">User List</h1>
    
    <div class="mb-3 text-right">
        <a href="{{ route('user.create') }}" class="btn btn-success"><i class="fas fa-plus"></i> Add User</a>
    </div>
    
    <table class="table table-striped table-hover">
        <thead class="thead-light">
            <tr>
                <th>Name</th>
                <th class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($usuarios as $usuario)
                <tr>
                    <td>{{ $usuario->name }}</td>
                    <td class="text-center">
                        <a href="{{ route('user.update', $usuario->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Edit</a>
                        <a href="{{ route('user.destroy', $usuario->id) }}" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Delete</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
            {{ $usuarios->links('pagination::bootstrap-4') }}
        </ul>
    </nav>
</div>
@endsection
