<!DOCTYPE html>
<html>
<head>
    <title>Edit Peminjam</title>
</head>
<body>
    <h1>Edit Data Peminjam</h1>

    <form action="{{ route('borrowing.update', $borrowing->id) }}" method="POST">
        @csrf 
        @method('PUT')
        <div>
            <label>Pilih Peminjam:</label><br>
            <select name="borrower_id" required>
                @foreach($borrowers as $b)
                    <option value="{{ $b->id }}" {{ $b->id == $borrowing->borrower_id ? 'selected' : '' }}>
                        {{ $b->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <br>
        <div>
            <label>Pilih Buku:</label><br>
            <select name="book_id" required>
                @foreach($books as $buku)
                    <option value="{{ $buku->id }}" {{ $buku->id == $borrowing->book_id ? 'selected' : '' }}>
                        {{ $buku->title }}
                    </option>
                @endforeach
            </select>
        </div>
        <br>
        <button type="submit">Update Data</button>
        <a href="/borrowing">Batal</a>
        
    </form>
</body>
</html>