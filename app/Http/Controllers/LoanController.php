<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert; 
use Illuminate\Support\Facades\Auth;

class LoanController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Necesitas iniciar sesión para acceder a esta página.');
        }
        $loans = Loan::with(['user', 'book'])->get();
        $loans = Loan::paginate(4); 
        return view('loans.index', compact('loans'));
    }

    public function create()
    {
        $books = Book::all();
        $users = User::all(); 
        return view('loans.create', compact('books', 'users')); 
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id',
            'loan_date' => 'required|date',
            'return_date' => 'nullable|date|after_or_equal:loan_date',
        ]);

        Loan::create([
            'user_id' => $request->user_id, 
            'book_id' => $request->book_id,
            'loan_date' => $request->loan_date,
            'return_date' => $request->return_date,
            'returned' => false,
        ]);
        Alert::success('Prestamo Creado', 'El prestamo ha sido creado')->flash();
        return redirect()->route('loans.index');
    }

    public function show(Loan $loan)
    {
        return view('loans.show', compact('loan'));
    }

    public function edit(Loan $loan)
    {
        $books = Book::all();
        $users = User::all(); 
        return view('loans.edit', compact('loan', 'books', 'users'));
    }

    public function update(Request $request, Loan $loan)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id',
            'loan_date' => 'required|date',
            'return_date' => 'nullable|date|after_or_equal:loan_date',
        ]);

        $loan->update([
            'user_id' => $request->user_id, 
            'book_id' => $request->book_id,
            'loan_date' => $request->loan_date,
            'return_date' => $request->return_date,
        ]);
        Alert::success('Prestamo Actualizado', 'El prestamo ha sido actualizado')->flash();
        return redirect()->route('loans.index');
    }

    public function destroy(Loan $loan)
    {
        $loan->delete();
        Alert::success('Prestamo Eliminado', 'El prestamo ha sido eliminado')->flash();
        return redirect()->route('loans.index');
    }
}
