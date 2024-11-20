<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mi aplicación @yield('title')</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        .navbar-brand { color: #4CAF50 !important; font-weight: bold; }
        .navbar-nav .nav-item .nav-link:hover { color: #FF5722; }
        .container { margin-top: 30px; }
        body { background-color: #f5f5f5; }
    </style>
    @yield('styles')
</head>
<body>
    @unless(request()->is('login'))
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">BIBLIOTECA</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    @if(Auth::check())
                        <li class="nav-item"><a class="nav-link" href="{{ route('books.index') }}"><i class="fas fa-book"></i> Libros</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('authors.index') }}"><i class="fas fa-user-secret"></i> Autores</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('genres.index') }}"><i class="fas fa-tags"></i> Géneros</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('editorials.index') }}"><i class="fas fa-newspaper"></i> Editoriales</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('loans.index') }}"><i class="fas fa-book-reader"></i> Préstamos</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('user.list') }}"><i class="fas fa-users"></i> Usuarios</a></li>
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="btn btn-link nav-link" style="color: inherit; text-decoration: none;">
                                    <i class="fas fa-sign-out-alt"></i> Cerrar sesión
                                </button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}"><i class="fas fa-sign-in-alt"></i> Iniciar sesión</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    @endunless

    <div class="container">
        @yield('content')
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
