<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Borrowing as BorrowingModel;
use App\Http\Resources\BorrowingResource;

class ApiBorrowingController extends Controller
{
    public function index() {
        $borrowings = BorrowingModel::with(['borrower', 'book'])->get();
        return response()->json([
            'message' => 'Daftar Transaksi Peminjaman',
            'data' => BorrowingResource::collection($borrowings) 
        ], 200);
    }

    public function show(int $id) {
        $borrowing = BorrowingModel::with(['borrower', 'book'])->findOrFail($id);
        
        return response()->json([
            'message' => 'Detail Transaksi Peminjaman',
            'data' => new BorrowingResource($borrowing)
        ], 200);
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
            'borrower_id' => 'required|exists:borrowers,id',
            'book_id' => 'required|exists:books,id',
        ]);

        $borrowing = BorrowingModel::create($validatedData);

        return response()->json([
            'message' => 'Transaksi Peminjaman berhasil dicatat!',
            'data' => $borrowing
        ], 201);
    }

    public function update(Request $request, int $id){
        $validatedData = $request->validate([
            'borrower_id' => 'required|exists:borrowers,id',
            'book_id' => 'required|exists:books,id',
        ]);

        $borrowing = BorrowingModel::findOrFail($id);
        $borrowing->borrower_id = $validatedData['borrower_id'];
        $borrowing->book_id = $validatedData['book_id'];
        $borrowing->save();

        return response()->json([
            'message' => 'Transaksi Peminjaman berhasil diubah!'
        ], 200);
    }

    public function destroy(int $id){
        $borrowing = BorrowingModel::findOrFail($id); 
        $borrowing->delete();     
        
        return response()->json([
            'message' => 'Transaksi peminjaman berhasil dihapus!'
        ], 200);
    }
}