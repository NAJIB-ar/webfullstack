<!DOCTYPE html>
<html>
<head>
    <title>Tambah Peminjam</title>
</head>
<body>
    <h1>Tambah Peminjam Baru</h1>

    <form action="/borrower" method="POST">
        
        @csrf 

        <div>
            <label>Nama Peminjam:</label><br>
            <input type="text" name="name" required placeholder="Masukkan nama peminjam">
        </div>
        <br>

        <div>
            <label>Kontak / No. HP:</label><br>
            <input type="text" name="kontak" required placeholder="Masukkan nomor kontak">
        </div>
        <br>

        <button type="submit">Simpan Data</button>
        <a href="/borrower">Batal</a>
        
    </form>
</body>
</html>