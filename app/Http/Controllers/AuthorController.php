<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert; 
use Illuminate\Support\Facades\Auth;

class AuthorController extends Controller
{
    // Mostrar lista de autores
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Necesitas iniciar sesión para acceder a esta página.');
        }
        $authors = Author::all();
        $authors = Author::paginate(4); 
        return view('authors.index', compact('authors'));
    }

    // Mostrar formulario de creación
    public function create()
    {
        return view('authors.create');
    }

    public function show(Author $author)
    {
        return view('authors.show', compact('author'));
    }

    // Guardar un autor
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'birth_date' => 'nullable|date',
        ]);
        
        Author::create($request->all());
        Alert::success('Autor Creado', 'El autor ha sido creado')->flash();
        return response()->json(['success' => True]);
    }

    // Mostrar formulario de edición
    public function edit(Author $author)
    {
        return view('authors.edit', compact('author'));
    }

    // Actualizar un autor
    public function update(Request $request, Author $author)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'birth_date' => 'nullable|date',
        ]);
        
        $author->update($request->all());
        Alert::success('Autor Actualizado', 'Los datos del autor ha sido actualizado')->flash();
        return response()->json(['success' => True]);
    }

    // Eliminar un autor
    public function destroy(Author $author)
    {
        $author->delete();
        Alert::success('Autor Eliminado', 'El autor ha sido eliminado')->flash();
        return redirect()->route('authors.index');
    }
}
