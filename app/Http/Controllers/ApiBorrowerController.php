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
        $borrowers = Borrower::findOrFail($id);
        return new BorrowerCollection($borrowers);
    }

    public function store(Request $request){
        $borrowers = new Borrower();
        $borrowers->name = $request->input('name');
        $borrowers->kontak = $request->input('kontak'); 
        $borrowers->save();

        return response()->json(
            ['message'=> 'Data Berhasil Dibuat'], 201
        );
    }

    public function update(Request $request, int $id){
        $borrowers = Borrower::findOrFail($id);
        $borrowers->name = $request->input('name');
        $borrowers->kontak = $request->input('kontak');
        $borrowers->save();

        return response()->json(
            ['message'=> 'Data Berhasil Diupdate'], 200
        );
    }

    public function destroy(int $id){
        $borrowers = Borrower::findOrFail($id);
        $borrowers->delete();

        return response()->json(
            ['message' => 'Data Berhasil Dihapus'], 200
        );
    }
}
