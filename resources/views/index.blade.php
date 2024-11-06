<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MENU</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f3f3f3;
        }
        .menu {
            background-color: #333;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .menu a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 10px;
            margin: 5px 0;
            background-color: #555;
            border-radius: 4px;
            text-align: center;
        }
        .menu a:hover {
            background-color: #777;
        }
        .menu h1 {
            color: white;
            text-align: center;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="menu">
        <h1>Menu de la biblioteca</h1>
        <a href="{{ route('books.index') }}">Libros</a>
        <a href="{{ route('authors.index') }}">Autores</a>
        <a href="{{ route('genres.index') }}">Generos</a>
        <a href="{{ route('editorials.index') }}">Editoriales</a>
        <a href="{{ route('loans.index') }}">Prestamos</a>
    </div>
</body>
</html>
