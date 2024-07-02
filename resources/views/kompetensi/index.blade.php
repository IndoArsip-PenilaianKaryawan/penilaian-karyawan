<!DOCTYPE html>
<html>

<head>
    <title>Daftar Kompetensi</title>
</head>

<body>
    <h1>Daftar Kompetensi</h1>
    <a href="{{ route('kompetensi.create') }}">Tambah Kompetensi</a>

    @if (session('success'))
    <div>
        {{ session('success') }}
    </div>
    @endif

    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Kompetensi</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kompetensi as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->nama_kompetensi }}</td>
                <td>{{ $item->deskripsi }}</td>
                <td>
                    <form action="{{ route('kompetensi.destroy', $item->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Hapus</button>
                    </form>
                    <a href="{{ route('kompetensi.edit', $item->id) }}">Edit</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
