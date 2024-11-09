<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Http\Requests\StoreUsuarioRequest;
use App\Http\Requests\UpdateUsuarioRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\SweetAlertServiceProvider;
use RealRashid\SweetAlert\Facades\Alert; #usado para el sweet alert
use Illuminate\Support\Facades\Auth;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Necesitas iniciar sesión para acceder a esta página.');
        }
    $user = Usuario::all();
    return view('index', compact('user')); 
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        /*return view('create');*/
        return view('vistas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $validated = $request->validate([
        'nombre' => 'required|string|max:10',
        'email' => 'required|email',
        'password' => 'required|string|min:6'
    ]);

    // Determinar el rol en función del dominio del correo electrónico
    $role = Str::endsWith($validated['email'], '@admin.com') ? 'admin' : 'user';

    // Crear el usuario con los datos ingresados y el rol determinado
    Usuario::create([
        'name' => $validated['nombre'],
        'email' => $validated['email'],
        'password' => Hash::make($validated['password']),
        'role' => $role
    ]);

    Alert::success('Éxito', 'El usuario ha sido creado')->flash();

    return redirect()->route('user.list');
}

    


    /**
     * Display the specified resource.
     */
    public function show(Usuario $usuario)
    {
        return view('show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //dd($id);
        $usuario = Usuario::find($id);
        //dd($usuario);
        return view('vistas.update', compact('usuario'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $usuario = Usuario::find($request->id);
        $usuario->name = $request->nombre;
        $usuario->save();
        Alert::success('Éxito', 'El usuario ha sido actualizado')->flash();
        return redirect()->route('user.list');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //BORRADO LOGICO: CAMBIA EL STATUS DE ACTIVO A INACTIVO
        $usuario = Usuario::find($id);
        $usuario->delete();
        Alert::success('ELIMINADO', '¡USUARIO ELIMINADO!');
        return redirect()->route('user.list');
    }

    public function list(){
        $usuarios = Usuario::paginate(4);
        #dd($usuarios);
        return view('vistas.list_users', compact('usuarios'));
    }
}
