<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert; 
use Illuminate\Support\Facades\Auth;

class GenreController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Necesitas iniciar sesión para acceder a esta página.');
        }
        $genres = Genre::all();
        $genres = Genre::paginate(4); 
        return view('genres.index', compact('genres'));
    }

    public function create()
    {
        return view('genres.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Genre::create($request->all());
        Alert::success('Genero Creado', 'El genero ha sido creado')->flash();
        return response()->json(['success' => True]);
    }

    public function show(Genre $genre)
    {
        return view('genres.show', compact('genre'));
    }

    public function edit(Genre $genre)
    {
        return view('genres.edit', compact('genre'));
    }

    public function update(Request $request, Genre $genre)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
        
        $genre->update($request->all());
        Alert::success('Genero Actualizado', 'El genero ha sido actualizado')->flash();
        return response()->json(['success' => True]);
    }

    public function destroy(Genre $genre)
    {
        $genre->delete();
        Alert::success('Genero Eliminado', 'El genero ha sido eliminado')->flash();
        return redirect()->route('genres.index');
    }
}
