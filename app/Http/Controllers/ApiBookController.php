<?php

namespace App\Http\Controllers;

use App\Http\Resources\BookCollection;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\Request;

class ApiBookController extends Controller
{
    public function index(){
        $books = Book::all();
        return new BookCollection($books);
    }

    public function show(int $id){
        $book = Book::findOrFail($id);
        return new BookResource($book);
    }

    public function store(Request $request){
        $book = new Book();
        $book->title = $request->input('title');
        $book->author = $request->input('author');
        $book->year = $request->input('year');
        $book->save();

        return response()->json(
            ['message' => 'Book Created Succes'], 201
        );
    }
        
    public function update(Request $request, int $id){
        $book = Book::findOrFail($id);
        $book->title = $request->input('title');
        $book->author = $request->input('author');
        $book->year = $request->input('year');
        $book->save();

        return response()->json(
            ['message' => 'Book Update Succes'], 200
        );
    }

    public function destroy(int $id){
        $book = Book::findOrFail($id);
        $book->delete();

        return response()->json(
            ['message' => 'Book Deleted Success'], 200
        );
    }
}
