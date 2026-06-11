<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Borrowing as BorrowingModel;
use App\Models\Borrower;
use App\Models\Book;

class Borrowing extends Controller
{
    public function index() {
        $borrowings = BorrowingModel::all();
        return view('borrowings.index', compact('borrowings'));
    }

    public function create() {
        $borrowers = Borrower::all();
        $books = Book::all();
        return view('borrowings.create', compact('borrowers', 'books'));
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
            'borrower_id' => 'required',
            'book_id' => 'required',
        ]);

        BorrowingModel::create($validatedData);

        return redirect('/borrowing')->with('success', 'Transaksi Peminjaman berhasil dicatat!');
    }

    public function edit(int $id) {
    $borrowing = BorrowingModel::findOrFail($id);
    $borrowers = Borrower::all();
    $books = Book::all();
    
    return view('borrowings.edit', compact('borrowing', 'borrowers', 'books'));
    }

    public function update(Request $request, int $id){
        $validatedData = $request->validate([
            'borrower_id' => 'required',
            'book_id' => 'required',
        ]);

        $borrowing = BorrowingModel::findOrFail($id);
        $borrowing->borrower_id = $validatedData['borrower_id'];
        $borrowing->book_id = $validatedData['book_id'];
        $borrowing->save();

        return redirect()->route('borrowing.index');
    }

    public function destroy(int $id){
        $borrowing = BorrowingModel::findOrFail($id); 
        $borrowing->delete();     
        return redirect()->route('borrower.index');
    }
}
