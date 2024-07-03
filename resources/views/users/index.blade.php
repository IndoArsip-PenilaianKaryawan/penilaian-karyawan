<!DOCTYPE html>
<html>

<head>
    <title>Daftar Pengguna</title>
</head>

<body>
    <h1>Daftar Pengguna</h1>
    <a href="{{ route('users.create') }}">Tambah Pengguna</a>

    @if (session('success'))
    <div>
        {{ session('success') }}
    </div>
    @endif

    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Nama</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->username }}</td>
                <td>{{ $user->name }}</td>
                <td>
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Hapus</button>
                    </form>
                    <a href="{{ route('users.edit', $user->id) }}">Edit</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
