<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use App\Models\Genre;
use App\Models\Editorial;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert; 
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Necesitas iniciar sesión para acceder a esta página.');
        }
        $books = Book::with(['author', 'genre', 'editorial'])->get();
        $books = Book::paginate(4); 
        return view('books.index', compact('books'));
    }

    public function create()
    {
        $authors = Author::all();
        $genres = Genre::all();
        $editorials = Editorial::all();
        return view('books.create', compact('authors', 'genres', 'editorials'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author_id' => 'required|exists:authors,id',
            'genre_id' => 'required|exists:genres,id',
            'editorial_id' => 'required|exists:editorials,id',
            'publication_year' => 'required|integer|digits:4',
            'description' => 'nullable|string',
            'stock' => 'required|integer|min:0',
        ]);

        Book::create($request->all());
        Alert::success('Libro Creado', 'El libro ha sido creado')->flash();
        return redirect()->route('books.index');
    }

    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

    public function edit(Book $book)
    {
        $authors = Author::all();
        $genres = Genre::all();
        $editorials = Editorial::all();
        return view('books.edit', compact('book', 'authors', 'genres', 'editorials'));
    }

    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author_id' => 'required|exists:authors,id',
            'genre_id' => 'required|exists:genres,id',
            'editorial_id' => 'required|exists:editorials,id',
            'publication_year' => 'required|integer|digits:4',
            'description' => 'nullable|string',
            'stock' => 'required|integer|min:0',
        ]);

        $book->update($request->all());
        Alert::success('Libro Actualizado', 'El libro ha sido actualizado')->flash();
        return redirect()->route('books.index');
    }

    public function destroy(Book $book)
    {
        $book->delete();
        Alert::success('Libro Eliminado', 'El libro ha sido eliminado')->flash();
        return redirect()->route('books.index');
    }
}
