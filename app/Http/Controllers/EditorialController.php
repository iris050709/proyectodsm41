<?php
namespace App\Http\Controllers;

use App\Models\Editorial;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert; 
use Illuminate\Support\Facades\Auth;

class EditorialController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Necesitas iniciar sesión para acceder a esta página.');
        }
        $editorials = Editorial::all();
        $editorials = Editorial::paginate(4); 
        return view('editorials.index', compact('editorials'));
    }

    public function create()
    {
        return view('editorials.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
        ]);
        Editorial::create($request->all());
        Alert::success('Editorial Creada', 'La editorial ha sido creada')->flash();
        return response()->json(['success' => True]);
    }

    public function show(Editorial $editorial)
    {
        return view('editorials.show', compact('editorial'));
    }

    public function edit(Editorial $editorial)
    {
        return view('editorials.edit', compact('editorial'));
    }

    public function update(Request $request, Editorial $editorial)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
        ]);
        $editorial->update($request->all());
        Alert::success('Editorial Actualizada', 'La editorial ha sido actualizada')->flash();
        return response()->json(['success' => True]);
    }

    public function destroy(Editorial $editorial)
    {
        $editorial->delete();
        Alert::success('Editorial Eliminada', 'La editorial ha sido eliminada')->flash();
        return redirect()->route('editorials.index');
    }
}
