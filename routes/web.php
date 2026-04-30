<?php

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\Routing\Router;

Route::get('/', function () {
    return view('welcome');
});

//basic
Route::get('/greeting', function () {
    return 'Hello World';
});

//required parameter
Route::get('/book/{id}', function (string $id) {
    return "Book id: " . $id;
});

//optional parameter
Route::get('/book-title/{title?}', function (?string $title = 'Bumi Manusia') {
    return "Book title: " . $title;
});

//named route
Route::get('/book-profile', function () {
    return 'book profile page';
})->name('book-profile');

//route prefixes
Route::prefix('admin')->group(function () {
    Route::get('/books', function () {
        return 'semua buku dari halaman admin';
    });

    Route::get('/authors', function () {
        return 'semua author dari halaman admin';
    });
});

//latihan modul 3
//roter book
Route::get('/book', function(){
    return "
    <body>
        <h1>Halaman Daftar Buku</h1>
        <table border='1' cellpadding='10' cellspacing='0'>
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Penulis</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Laskar Pelangi</td>
                    <td>Andrea Hirata</td>
                </tr>
                <tr>
                    <td>Bumi</td>
                    <td>Tere Liye</td>
                </tr>
            </tbody>
        </table>
    </body>
    ";
});

//router borrower
Route::get('/borrower', function(){
    return "
    <body>
        <h1>Halaman Daftar Peminjaman</h1>
        <table border='1' cellpadding='10' cellspacing='0'>
            <thead>
                <tr>
                    <th>Nama Peminjam</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Budi Hartomo</td>
                    <td>Kepala IT</td>
                </tr>
                <tr>
                    <td>Eka Setyo</td>
                    <td>Mahasiswa</td>
                </tr>
            </tbody>
        </table>
    </body>
    ";
});

//router borrowing
Route::get('/borrowing', function(){
    return "
    <body>
        <h1>Halaman Daftar Judul Buku yang Dipinjam</h1>
        <table border='1' cellpadding='10' cellspacing='0'>
            <thead>
                <tr>
                    <th>Nama Peminjam</th>
                    <th>Nama Buku</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Budi Hartomo</td>
                    <td>Tere Liye</td>
                </tr>
                <tr>
                    <td>Eka Setyo</td>
                    <td>Seporsi Mie Ayam Sebelum Mati</td>
                </tr>
            </tbody>
        </table>
    </body>
    ";
});

//modul 4
Route::get('book-simple', function(){
    return view('book_simple', ['title' => 'Bumi Manusia']);
});

//route tampilkan data buku
Route::get('/books', function(){
    $books = Book::all();
    return view('books.index', ['books' => $books]);
})-> name('books.index');

//route tampilkan add buku
Route::get('/books/create', function(){
    return view('books.create');
})-> name('books.create');

//route tampilkan data buku yang baru ditambahkan
Route::post('/books', function (Request $request){
    $validatedData = $request->validate([
        'title' => 'required',
        'author' => 'required',
        'year' => 'required',
    ]);

    $book = new Book();
    $book->title = $validatedData['title'];
    $book->author = $validatedData['author'];
    $book->year = $validatedData['year'];
    $book->save();
})-> name('books.store');

//route tampilkan form edit buku
Route::get('/books/{id}/edit', function ($id){
    $book = Book::findOrFail($id);
    return view('books.edit', ['book' => $book]);
})->name('books.edit');

//route tampilkan data buku yang diubah
Route::put('/books/{id}', function(Request $request, $id){
    $validatedData = $request->validate([
        'title' => 'required',
        'author' => 'required',
        'year' => 'required',
    ]);

    $book = Book::findOrFail($id);
    $book->title = $validatedData['title'];
    $book->author = $validatedData['author'];
    $book->year = $validatedData['year'];
    $book->save();
})->name('books.update');

//route hapus data buku
Route::delete('/books/{id}', function($id){
    $book = Book::findOrFail($id);
    $book->delete();

    return redirect()->route('books.index');
})->name('books.destroy');

//route peminjam buku atau borrower

//route peminjam dan buku yang dipinjam atau borrowing