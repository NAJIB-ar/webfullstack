<!DOCTYPE html>
<html>
<head>
    <title>Daftar Peminjam</title>
</head>
<body>
    <h1>Daftar Peminjam Buku</h1>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <a href="/borrower/create">Tambah Peminjam Baru</a>
    <br><br>

    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
                <th>ID</th>
                <th>Nama Peminjam</th>
                <th>Kontak / No. HP</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($borrowers as $b)
            <tr>
                <td>{{ $b->id }}</td>
                <td>{{ $b->name }}</td>
                <td>{{ $b->kontak }}</td>
                <td>
                    <a href="{{ route('borrower.edit', $b->id) }}">Edit</a>
                    <form action="
                        {{ route('borrower.destroy', $b->id) }}"
                        method="POST" style="display: inline;">
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