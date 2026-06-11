<!DOCTYPE html>
<html>
<head>
    <title>Edit Peminjam</title>
</head>
<body>
    <h1>Edit Data Peminjam</h1>

    <form action="{{ route('borrower.update', $borrower->id) }}" method="POST">
        @csrf 
        @method('PUT')
        <div>
            <label>Nama Peminjam:</label><br>
            <input type="text" name="name" required value="{{ $borrower->name }}">
        </div>
        <br>
        <div>
            <label>Kontak / No. HP:</label><br>
            <input type="text" name="kontak" required value="{{ $borrower->kontak }}">
        </div>
        <br>
        <button type="submit">Update Data</button>
        <a href="/borrower">Batal</a>
        
    </form>
</body>
</html>