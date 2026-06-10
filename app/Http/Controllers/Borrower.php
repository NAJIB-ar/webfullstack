<?php

namespace App\Http\Controllers;

use App\Models\Borrower as BorrowerModel;
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

}
