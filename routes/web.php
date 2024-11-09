<?php
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckAdmin;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\EditorialController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\LoanController;


Route::get('/', function () {
    return view('welcome');
});

// Ruta para listar usuarios

Route::get('/menu', [UsuarioController::class, 'index'])->name('usuario.menu');

// Rutas para crear y almacenar un nuevo usuario
Route::get('/create', [UsuarioController::class, 'create'])->name('usuario.create');
/*Route::post('/store', [UsuarioController::class, 'store'])->name('usuario.store');*/

// Rutas para editar y actualizar un usuario
Route::get('/edit/{usuario}', [UsuarioController::class, 'edit'])->name('usuario.edit');
Route::put('/update/{usuario}', [UsuarioController::class, 'update'])->name('usuario.update');

// Ruta para eliminar un usuario
Route::delete('/destroy/{usuario}', [UsuarioController::class, 'destroy'])->name('usuario.destroy');

// Ruta para mostrar un usuario específico
Route::get('/show/{usuario}', [UsuarioController::class, 'show'])->name('usuario.show');
Route::get('/usuario/creado', [UsuarioController::class, 'create'])->name('user.create');
Route::post('/usuario/creado', [UsuarioController::class, 'store'])->name('user.store');
Route::get('/usuario/list', [UsuarioController::class,'list'])->name('user.list');
Route::get('/usuario/update/{id}', [UsuarioController::class,'edit'])->name('user.update');
Route::post('/usuario/update', [UsuarioController::class,'update'])->name('user.update.data');
Route::get('/usuario/delete/{id}', [UsuarioController::class,'destroy'])->name('user.destroy');

Route::get('login', [AuthController::class, 'showLogin']);
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/home', function(){
    return view('home');
})->name('home');


Route::middleware([CheckAdmin::class])->group(function(){
    // Rutas para books (BookController)
    Route::get('books', [BookController::class, 'index']);
    Route::get('books/create', [BookController::class, 'create']);
    Route::post('books', [BookController::class, 'store']);
    Route::get('books/{book}', [BookController::class, 'show']);
    Route::get('books/{book}/edit', [BookController::class, 'edit']);
    Route::put('books/{book}', [BookController::class, 'update']);
    Route::delete('books/{book}', [BookController::class, 'destroy']);

    // Rutas para authors (AuthorController)
    Route::get('authors', [AuthorController::class, 'index']);
    Route::get('authors/create', [AuthorController::class, 'create']);
    Route::post('authors', [AuthorController::class, 'store']);
    Route::get('authors/{author}', [AuthorController::class, 'show']);
    Route::get('authors/{author}/edit', [AuthorController::class, 'edit']);
    Route::put('authors/{author}', [AuthorController::class, 'update']);
    Route::delete('authors/{author}', [AuthorController::class, 'destroy']);

    // Rutas para editorials (EditorialController)
    Route::get('editorials', [EditorialController::class, 'index']);
    Route::get('editorials/create', [EditorialController::class, 'create']);
    Route::post('editorials', [EditorialController::class, 'store']);
    Route::get('editorials/{editorial}', [EditorialController::class, 'show']);
    Route::get('editorials/{editorial}/edit', [EditorialController::class, 'edit']);
    Route::put('editorials/{editorial}', [EditorialController::class, 'update']);
    Route::delete('editorials/{editorial}', [EditorialController::class, 'destroy']);

    // Rutas para genres (GenreController)
    Route::get('genres', [GenreController::class, 'index']);
    Route::get('genres/create', [GenreController::class, 'create']);
    Route::post('genres', [GenreController::class, 'store']);
    Route::get('genres/{genre}', [GenreController::class, 'show']);
    Route::get('genres/{genre}/edit', [GenreController::class, 'edit']);
    Route::put('genres/{genre}', [GenreController::class, 'update']);
    Route::delete('genres/{genre}', [GenreController::class, 'destroy']);

    // Rutas para loans (LoanController)
    Route::get('loans', [LoanController::class, 'index']);
    Route::get('loans/create', [LoanController::class, 'create']);
    Route::post('loans', [LoanController::class, 'store']);
    Route::get('loans/{loan}', [LoanController::class, 'show']);
    Route::get('loans/{loan}/edit', [LoanController::class, 'edit']);
    Route::put('loans/{loan}', [LoanController::class, 'update']);
    Route::delete('loans/{loan}', [LoanController::class, 'destroy']);

});
