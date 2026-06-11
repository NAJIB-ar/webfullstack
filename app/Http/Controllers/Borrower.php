<?php

namespace App\Http\Controllers;

use App\Models\Borrower as BorrowerModel;
use App\Models\Borrowing;
use Illuminate\Http\Request;

class Borrower extends Controller
{
    public function index(){
        $borrowers = BorrowerModel::all(); 
        return view('borrowers.index', compact('borrowers'));
    }

    public function create(){
        return view('borrowers.create');
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'kontak' => 'required|max:250',
        ]);

        BorrowerModel::create($validatedData);

        return redirect('/borrower')->with('success', 'Peminjam berhasil ditambahkan!');
    }

    public function edit(int $id) {
        $borrower = BorrowerModel::findOrFail($id); 
        return view('borrowers.edit', compact('borrower'));
    }

    public function update(Request $request, int $id){
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'kontak' => 'required|max:250',
        ]);

        $borrower = BorrowerModel::findOrFail($id);
        $borrower->name = $validatedData['name'];
        $borrower->kontak = $validatedData['kontak'];
        $borrower->save();

        return redirect()->route('borrower.index');
    }

    public function destroy(int $id){
        $borrower = BorrowerModel::findOrFail($id); 
        Borrowing::where('borrower_id', $id)->delete();
        $borrower->delete();     
        return redirect()->route('borrower.index');
    }
}
