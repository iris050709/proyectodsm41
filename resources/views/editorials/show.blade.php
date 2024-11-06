@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editorial: {{ $editorial->name }}</h1>
    <p><strong>Dirección:</strong> {{ $editorial->address }}</p>
    <p><strong>Teléfono:</strong> {{ $editorial->phone }}</p>

    <center><div class="d-flex justify-content-between">
        <a href="{{ route('editorials.index') }}" class="btn btn-secondary">Volver a la Lista</a>
        <a href="{{ route('editorials.edit', $editorial->id) }}" class="btn btn-warning">Editar</a>
    </div></center>
</div>

<style>
    h1 {
        margin-bottom: 20px;
        text-align: center;
        color: #333;
    }

    .container {
        background-color: #f8f9fa;
        border-radius: 8px;
        padding: 20px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        border: 1px solid #dee2e6;
    }
    .btn-secondary {
        background-color: #bcdafa;
        border-color: #007bff;
    }
</style>
@endsection
