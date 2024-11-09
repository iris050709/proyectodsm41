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
    Route::get('/usuario/list', [UsuarioController::class,'list'])->name('user.list');
    // Rutas para books (BookController)
    Route::get('books', [BookController::class, 'index'])->name('books.index');
    Route::get('books/create', [BookController::class, 'create'])->name('books.create');
    Route::post('books', [BookController::class, 'store'])->name('books.store');
    Route::get('books/{book}', [BookController::class, 'show'])->name('books.show');
    Route::get('books/{book}/edit', [BookController::class, 'edit'])->name('books.edit');
    Route::put('books/{book}', [BookController::class, 'update'])->name('books.update');
    Route::delete('books/{book}', [BookController::class, 'destroy'])->name('books.destroy');

    // Rutas para authors (AuthorController)
    Route::get('authors', [AuthorController::class, 'index'])->name('authors.index');
    Route::get('authors/create', [AuthorController::class, 'create'])->name('authors.create');
    Route::post('authors', [AuthorController::class, 'store'])->name('authors.store');
    Route::get('authors/{author}', [AuthorController::class, 'show'])->name('authors.show');
    Route::get('authors/{author}/edit', [AuthorController::class, 'edit'])->name('authors.edit');
    Route::put('authors/{author}', [AuthorController::class, 'update'])->name('authors.update');
    Route::delete('authors/{author}', [AuthorController::class, 'destroy'])->name('authors.destroy');

    // Rutas para editorials (EditorialController)
    Route::get('editorials', [EditorialController::class, 'index'])->name('editorials.index');
    Route::get('editorials/create', [EditorialController::class, 'create'])->name('editorials.create');
    Route::post('editorials', [EditorialController::class, 'store'])->name('editorials.store');
    Route::get('editorials/{editorial}', [EditorialController::class, 'show'])->name('editorials.show');
    Route::get('editorials/{editorial}/edit', [EditorialController::class, 'edit'])->name('editorials.edit');
    Route::put('editorials/{editorial}', [EditorialController::class, 'update'])->name('editorials.update');
    Route::delete('editorials/{editorial}', [EditorialController::class, 'destroy'])->name('editorials.destroy');

    // Rutas para genres (GenreController)
    Route::get('genres', [GenreController::class, 'index'])->name('genres.index');
    Route::get('genres/create', [GenreController::class, 'create'])->name('genres.create');
    Route::post('genres', [GenreController::class, 'store'])->name('genres.store');
    Route::get('genres/{genre}', [GenreController::class, 'show'])->name('genres.show');
    Route::get('genres/{genre}/edit', [GenreController::class, 'edit'])->name('genres.edit');
    Route::put('genres/{genre}', [GenreController::class, 'update'])->name('genres.update');
    Route::delete('genres/{genre}', [GenreController::class, 'destroy'])->name('genres.destroy');

    // Rutas para loans (LoanController)
    Route::get('loans', [LoanController::class, 'index'])->name('loans.index');
    Route::get('loans/create', [LoanController::class, 'create'])->name('loans.create');
    Route::post('loans', [LoanController::class, 'store'])->name('loans.store');
    Route::get('loans/{loan}', [LoanController::class, 'show'])->name('loans.show');
    Route::get('loans/{loan}/edit', [LoanController::class, 'edit'])->name('loans.edit');
    Route::put('loans/{loan}', [LoanController::class, 'update'])->name('loans.update');
    Route::delete('loans/{loan}', [LoanController::class, 'destroy'])->name('loans.destroy');
});
