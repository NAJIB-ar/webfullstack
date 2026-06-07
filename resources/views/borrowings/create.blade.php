<!DOCTYPE html>
<html>
<head>
    <title>Tambah Transaksi</title>
</head>
<body>
    <h1>Catat Peminjaman Baru</h1>

    <form action="/borrowing" method="POST">
        @csrf 

        <div>
            <label>Pilih Peminjam:</label><br>
            <select name="borrower_id" required>
                <option value="">-- Pilih Peminjam --</option>
                @foreach($borrowers as $b)
                    <option value="{{ $b->id }}">{{ $b->name }}</option>
                @endforeach
            </select>
        </div>
        <br>

        <div>
            <label>Pilih Buku:</label><br>
            <select name="book_id" required>
                <option value="">-- Pilih Buku --</option>
                @foreach($books as $buku)
                    <option value="{{ $buku->id }}">{{ $buku->title }}</option>
                @endforeach
            </select>
        </div>
        <br>

        <button type="submit">Simpan Transaksi</button>
        <a href="/borrowing">Batal</a>
        
    </form>
</body>
</html>