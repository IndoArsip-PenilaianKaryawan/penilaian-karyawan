<!DOCTYPE html>
<html>

<head>
    <title>Daftar Pengguna</title>
</head>

<body>
    <h1>Daftar Pengguna</h1>
    <a href="/users/create">Tambah users</a>

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
                <th>Name</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }} <a href="users/"></a> </td>
                <td>{{ $user->username }}</td>
                <td>{{ $user->name }}</td>
                <td>
                    <form action="{{ route('users.destroy', $user->id) }}" method="DELETE">
                        @csrf
                        <button type="submit">Hapus</button>
                    </form>
                </td>
                <td>
                    <form action="{{ route('users.edit', $user->id) }}">
                        @csrf
                        <button type="submit">Edit</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
