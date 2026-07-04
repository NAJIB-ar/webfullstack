<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\Borrower as ControllersBorrower;
use App\Http\Controllers\Borrowing as ControllersBorrowing;
use App\Models\Book;
use App\Models\Borrower;
use App\Models\Borrowing;
use App\Models\User;
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
Route::get('/book', function () {
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

// //router borrower
// Route::get('/borrower', function(){
//     return "
//     <body>
//         <h1>Halaman Daftar Peminjaman</h1>
//         <table border='1' cellpadding='10' cellspacing='0'>
//             <thead>
//                 <tr>
//                     <th>Nama Peminjam</th>
//                     <th>Status</th>
//                 </tr>
//             </thead>
//             <tbody>
//                 <tr>
//                     <td>Budi Hartomo</td>
//                     <td>Kepala IT</td>
//                 </tr>
//                 <tr>
//                     <td>Eka Setyo</td>
//                     <td>Mahasiswa</td>
//                 </tr>
//             </tbody>
//         </table>
//     </body>
//     ";
// });

// //router borrowing
// Route::get('/borrowing', function(){
//     return "
//     <body>
//         <h1>Halaman Daftar Judul Buku yang Dipinjam</h1>
//         <table border='1' cellpadding='10' cellspacing='0'>
//             <thead>
//                 <tr>
//                     <th>Nama Peminjam</th>
//                     <th>Nama Buku</th>
//                 </tr>
//             </thead>
//             <tbody>
//                 <tr>
//                     <td>Budi Hartomo</td>
//                     <td>Tere Liye</td>
//                 </tr>
//                 <tr>
//                     <td>Eka Setyo</td>
//                     <td>Seporsi Mie Ayam Sebelum Mati</td>
//                 </tr>
//             </tbody>
//         </table>
//     </body>
//     ";
// });

//modul 4
Route::get('book-simple', function () {
    return view('book_simple', ['title' => 'Bumi Manusia']);
});

//route tampilkan data buku
Route::get('/books', function () {
    $books = Book::all();
    return view('books.index', ['books' => $books]);
})->name('books.index');

//route tampilkan add buku
Route::get('/books/create', function () {
    return view('books.create');
})->name('books.create');

//route tampilkan data buku yang baru ditambahkan
Route::post('/books', function (Request $request) {
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

    return redirect()->route('books.index');
})->name('books.store');

//route tampilkan form edit buku
Route::get('/books/{id}/edit', function ($id) {
    $book = Book::findOrFail($id);
    return view('books.edit', ['book' => $book]);
})->name('books.edit');

//route tampilkan data buku yang diubah
Route::put('/books/{id}', function (Request $request, $id) {
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

    return redirect()->route('books.index');
})->name('books.update');

//route hapus data buku
Route::delete('/books/{id}', function ($id) {
    $book = Book::findOrFail($id);
    $book->delete();

    return redirect()->route('books.index');
})->name('books.destroy');

//route borrower
// Route::get('/borrower', function () {
//     $borrowers = Borrower::all();
//     return view('borrowers.index', compact('borrowers'));
// })->name('borrower.index');

// Route::get('/borrower/create', function () {
//     return view('borrowers.create');
// })->name('borrower.create');

// Route::post('/borrower', function (Request $request) {
//     $validatedData = $request->validate([
//         'name' => 'required|string|max:255',
//         'kontak' => 'required|max:250',
//     ]);

//     Borrower::create($validatedData);

//     return redirect('/borrower')->with('success', 'Peminjam berhasil ditambahkan!');
// })->name('borrower.store');

// Route::get('/borrower/{id}/edit', function ($id) {
//     $borrower = Borrower::findOrFail($id);
//     return view('borrowers.edit', compact('borrower'));
// })->name('borrower.edit');

// Route::put('/borrower/{id}', function(Request $request, $id){
//     $validatedData = $request->validate([
//         'name' => 'required|string|max:255',
//         'kontak' => 'required|max:250',
//     ]);

//     $borrower = Borrower::findOrFail($id);
//     $borrower->name = $validatedData['name'];
//     $borrower->kontak = $validatedData['kontak'];
//     $borrower->save();

//     return redirect('/borrower')->with('success', 'Data peminjam berhasil diubah!');
// })->name('borrower.update');

// Route::delete('/borrower/{id}', function ($id) {
//     $borrower = Borrower::findOrFail($id);
//     Borrowing::where('borrower_id', $id)->delete();
//     $borrower->delete();
//     return redirect('/borrower')->with('success', 'Data peminjam berhasil dihapus!');
// })->name('borrower.destroy');


//route borrowing
// Route::get('/borrowing', function () {
//     $borrowings = Borrowing::with(['borrower', 'book'])->get();
//     return view('borrowings.index', compact('borrowings'));
// })->name('borrowing.index');

// Route::get('/borrowing/create', function () {
//     $borrowers = Borrower::all();
//     $books = Book::all();
//     return view('borrowings.create', compact('borrowers', 'books'));
// })->name('borrowing.create');

// Route::post('/borrowing', function (Request $request) {
//     $validatedData = $request->validate([
//         'borrower_id' => 'required',
//         'book_id' => 'required',
//     ]);

//     Borrowing::create($validatedData);

//     return redirect('/borrowing')->with('success', 'Transaksi Peminjaman berhasil dicatat!');
// })->name('borrowing.store');

// Route::get('/borrowing/{id}/edit', function ($id) {
//     $borrowing = Borrowing::findOrFail($id);
//     $borrowers = Borrower::all();
//     $books = Book::all();

//     return view('borrowings.edit', compact('borrowing', 'borrowers', 'books'));
// })->name('borrowing.edit');

// Route::put('/borrowing/{id}', function(Request $request, $id){
//     $validatedData = $request->validate([
//         'borrower_id' => 'required',
//         'book_id' => 'required',
//     ]);

//     $borrowing = Borrowing::findOrFail($id);
//     $borrowing->borrower_id = $validatedData['borrower_id'];
//     $borrowing->book_id = $validatedData['book_id'];
//     $borrowing->save();

//     return redirect('/borrowing')->with('success', 'Transaksi Peminjaman berhasil diubah!');
// })->name('borrowing.update');

// Route::delete('/borrowing/{id}', function ($id) {
//     $borrowing = Borrowing::findOrFail($id);
//     $borrowing->delete();

//     return redirect('/borrowing')->with('success', 'Transaksi peminjaman berhasil dihapus!');
// })->name('borrowing.destroy');


// prak5
// Route::get('/books', [BookController::class, 'index'])->name('books.index');
// Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
// Route::post('/books', [BookController::class, 'store'])->name('books.store');
// Route::get('/books/{id}/edit', [BookController::class, 'edit'])->name('books.edit');
// Route::put('/books/{id}', [BookController::class, 'update'])->name('books.update');
// Route::delete('/books/{id}', [BookController::class, 'destroy'])->name('books.destroy');

// //borrower
Route::get('/borrower', [ControllersBorrower::class, 'index'])->name('borrower.index');
Route::get('/borrower/create', [ControllersBorrower::class, 'create'])->name('borrower.create');
Route::post('/borrower', [ControllersBorrower::class, 'store'])->name('borrower.store');
Route::get('/borrower/{id}/edit', [ControllersBorrower::class, 'edit'])->name('borrower.edit');
Route::put('/borrower/{id}', [ControllersBorrower::class, 'update'])->name('borrower.update');
Route::delete('/borrower/{id}', [ControllersBorrower::class, 'destroy'])->name('borrower.destroy');

// //borrowing
Route::get('/borrowing', [ControllersBorrowing::class, 'index'])->name('borrowing.index');
Route::get('/borrowing/create', [ControllersBorrowing::class, 'create'])->name('borrowing.create');
Route::post('/borrowing', [ControllersBorrowing::class, 'store'])->name('borrowing.store');
Route::get('/borrowing/{id}/edit', [ControllersBorrowing::class, 'edit'])->name('borrowing.edit');
Route::put('/borrowing/{id}', [ControllersBorrowing::class, 'update'])->name('borrowing.update');
Route::delete('/borrowing/{id}', [ControllersBorrowing::class, 'destroy'])->name('borrowing.destroy');


// prak8
Route::get('/user-profile/{useer_id}', function (string $id) {
    $user = User::find($id);
    echo $user->name;
    echo "<br>";
    echo $user->profile->address;
});
