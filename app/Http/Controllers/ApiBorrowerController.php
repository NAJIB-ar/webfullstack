<?php

namespace App\Http\Controllers;

use App\Http\Resources\BorrowerCollection;
use App\Models\Borrower;
use Illuminate\Http\Request;

class ApiBorrowerController extends Controller
{
    public function index(){
        $borrowers = Borrower::all();
        return new BorrowerCollection($borrowers);
        }
        
    public function show(int $id){
        $borrower = Borrower::findOrFail($id);
        return response()->json([
            'message' => 'Detail Data Peminjam',
            'data' => $borrower
        ], 200);
    }

    public function store(Request $request){
        $borrower = new Borrower();
        $borrower->name = $request->input('name');
        $borrower->kontak = $request->input('kontak'); 
        $borrower->save();

        return response()->json(
            ['message'=> 'Data Berhasil Dibuat'], 201
        );
    }

    public function update(Request $request, int $id){
        $borrower = Borrower::findOrFail($id);
        $borrower->name = $request->input('name');
        $borrower->kontak = $request->input('kontak');
        $borrower->save();

        return response()->json(
            ['message'=> 'Data Berhasil Diupdate'], 200
        );
    }

    public function destroy(int $id){
        $borrower = Borrower::findOrFail($id);
        $borrower->delete();

        return response()->json(
            ['message' => 'Data Berhasil Dihapus'], 200
        );
    }
}
