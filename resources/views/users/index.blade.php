<!DOCTYPE html>
<html>

<head>
    <title>Daftar Pengguna</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        table,
        th,
        td {
            border: 2px solid white;
            box-shadow: #E1E1E1 0px 2px 2px;
        }

        td {
            padding: 8px;
            text-align: center;
            background: white;
            font-size: 14px;
        }

        th {
            padding: 8px;
            text-align: center;
            background: #9F2D2D;
            color: white;
            font-size: 14px;
            font-weight: 500;
        }

        thead {
            background-color: #9F2D2D;
            color: white;
        }
    </style>
</head>


<body>
    @include ('component.sidebar')
    <div class="px-4 py-8 xl:ml-80 bg-[#F5F6F7] min-h-screen">
        <h1 class="text-3xl font-semibold ">Halaman User</h1>
        <div class="my-4 flex justify-start items-center w-full ">
            <div class="p-4 bg-[#E5E5E5]  rounded-l-2xl  text-sm w-1/3">
                <i class="fas fa-search text-[#34364A]  pr-2"></i>
                <input id="searchInput" class="bg-transparent outline-0 w-10/12" type="text" placeholder="Cari User..." onkeyup="searchKaryawan()">
            </div>
            <button class="py-4 px-6 bg-[#9F2D2D] text-white rounded-r-2xl  text-sm" onclick="searchKaryawan()">
                Cari
            </button>
            <a class="bg-[#9F2D2D] text-white p-4  rounded-2xl text-sm ml-4" href="/users/create"> <i class="fas fa-plus pr-2"></i> Tambah User</a>
        </div>

        @if (session('success'))
        <div>
            {{ session('success') }}
        </div>
        @endif

        <table border="1" id="usersTable">
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
                        <a href="{{ route('users.edit', $user->id) }}" class="bg-[#EBFFE9] text-[#2D9F46] px-2 py-1 rounded-full">EDIT</a>
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-[#FCE9FF] text-[#9F2D2D] px-2 py-1 rounded-full">HAPUS</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>



</html>
