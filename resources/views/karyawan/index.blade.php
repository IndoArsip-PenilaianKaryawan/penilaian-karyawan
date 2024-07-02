<!DOCTYPE html>
<html>

<head>
    <title>Daftar Karyawan</title>
</head>

<body>
    <h1>Daftar Karyawan</h1>
    <a href="/karyawan/create">Tambah Karyawan</a>

    @if (session('success'))
    <div>
        {{ session('success') }}
    </div>
    @endif

    <table border="1">
        <thead>
            <tr>
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
</body>

</html>
