<!DOCTYPE html>
<html>
<head>
    <title>Daftar Peminjaman</title>
</head>
<body>
    <h1>Data Transaksi Peminjaman</h1>

    <a href="/borrowing/create">Tambah Peminjaman Baru</a>
    <br><br>

    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>ID Transaksi</th>
                <th>Nama Peminjam</th>
                <th>Buku yang Dipinjam</th>
                <th>Tanggal Pinjam</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($borrowings as $transaksi)
            <tr>
                <td>{{ $transaksi->id }}</td>
                <td>{{ $transaksi->borrower->name }}</td>
                <td>{{ $transaksi->book->title }}</td>
                <td>{{ $transaksi->created_at->format('d M Y') }}</td>
                <td>
                    <a href="{{ route('borrowing.edit', $transaksi->id) }}">Edit</a>
                    <form action="{{ route('borrowing.destroy', $transaksi->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>