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
        //dd($request->all());
        /*$validated=$request->validate(
            ['nombre' => 'required|string|max:10']
        );
        //dd($validated);

        Usuario::create([
            'name' => $validated['nombre'],
            'email' => 'correo@gmail.com',
            'password' => '12345',
        ]);*/
        //$user = Usuario::create(['name' => 'Prueba', 'email' => 'prueba@example.com']);

        /*$validatedData = $request->validated();
        //dd($validatedData);
    
        // Crear un nuevo usuario
        $user = Usuario::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
        ]);
        
        // Verificar si el usuario fue creado
        if ($user) {
            return redirect()->route('usuario.index')->with('success', 'Usuario creado exitosamente');
        } else {
            return redirect()->back()->with('error', 'Error al crear el usuario');
        }*/
        //dd($request->all());
        $validated= $request->validate(
            ['nombre' => 'required|string|max:10']
        );
        Usuario::create([
            'name' => $validated['nombre'],
            'email' =>  Str::random(10).'@gmail', 
            'password' => Hash::make("Hola123")
        ]);
        Alert::success('Exito Usuario Creado', 'El usuario ha sido creado')->flash();//EL  FLASH ES PARA QUE NO SE ELIMINE SOLO
        //return view('vistas.list_users'); //PARA REDIRECCIONAR A UNA VISTA
        return redirect()->route('user.list'); //PARA REDIRECCIONAR A UNA RUTA
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
