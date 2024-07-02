<!DOCTYPE html>
<html>

<head>
    <title>Daftar Karyawan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        table, th, td {
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
    <h1 class="text-3xl font-semibold ">Halaman Karyawan</h1>
    <div class=" my-4 flex justify-end">
        <a class="bg-[#9F2D2D] text-white px-4 py-2 rounded-md text-sm " href="/karyawan/create"> <i class="fas fa-plus pr-2"></i> Tambah Karyawan</a>
    </div>

    @if (session('success'))
    <div>
        {{ session('success') }}
    </div>
    @endif

    <table border="1">
        <thead>
            <tr >
                <th>ID</th>
                <th>Nama</th>
                <th>No Pegawai</th>
                <th>Bidang</th> 
                <th>jabatan</th> 
                <th>atasan</th> 
                <th>Approval 1</th> 
                <th>Approval 2</th> 
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($karyawans as $karyawan)
            <tr>
                <td>{{ $karyawan->id }}</td>
                <td>{{ $karyawan->nama }}</td>
                <td>{{ $karyawan->no_pegawai }}</td>
                <td>{{ $karyawan->bidang->nama_bidang }}</td>
                <td>{{ $karyawan->jabatan->nama_jabatan }}</td>
                <td>{{ $karyawan->atasan->name }}</td>
                <td>{{ $karyawan->approval1->name }}</td>
                <td>{{ $karyawan->approval2->name }}</td>
                <td>
                    <a href="{{ route('karyawan.edit', $karyawan->id) }}">Edit</a>
                    <form action="{{ route('karyawan.destroy', $karyawan->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</body>

</html>
