<!DOCTYPE html>
<html>

<head>
    <title>Tambah Karyawan</title>
</head>

<body>
    <h1>Tambah Karyawan</h1>
    <form action="{{url("karyawan/{$karyawan->id}")}}" method="POST">
        @method('PATCH')
        @csrf
        <div>
            <label for="nama">Nama:</label>
            <input type="text" id="nama" name="nama" required value="{{$karyawan->nama}}">
        </div>
        <div>
            <label for="no_pegawai">No Pegawai:</label>
            <input type="text" id="no_pegawai" name="no_pegawai" required value="{{$karyawan->no_pegawai}}">
        </div>
        <div>
            <label for="id_departement">Departemen:</label>
            <select id="id_departement" name="id_departement" required onchange=getBidangs()>
                @foreach ($departements as $departement)
                <option value="{{ $departement->id }}"  @if ($departement->id == $karyawan->bidang->id_departement) selected @endif >{{ $departement->nama_departement }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="id_bidang">Bidang:</label>
            <select id="id_bidang" name="id_bidang" required >
                @foreach ($bidangs as $bidang)
                <option value="{{ $bidang->id }}"  @if ($bidang->id == $karyawan->id_bidang) selected @endif >{{ $bidang->nama_bidang }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="id_jabatan">Jabatan:</label>
            <select id="id_jabatan" name="id_jabatan" required>
                @foreach ($jabatans as $jabatan)
                <option value="{{ $jabatan->id }}" @if ($jabatan->id == $karyawan->id_jabatan) selected @endif >{{ $jabatan->nama_jabatan }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="id_atasan">Atasan:</label>
            <select id="id_atasan" name="id_atasan" required>
                @foreach ($users as $user)
                <option value="{{ $user->id }}" @if ($user->id == $karyawan->id_atasan) selected @endif >{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="id_approval_1">Approval 1:</label>
            <select id="id_approval_1" name="id_approval_1" required>
                @foreach ($users as $user)
                <option value="{{ $user->id }}" @if ($user->id == $karyawan->id_approval_1) selected @endif>{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="id_approval_2">Approval 2:</label>
            <select id="id_approval_2" name="id_approval_2" required>
                @foreach ($users as $user)
                <option value="{{ $user->id }}" @if ($user->id == $karyawan->id_approval_2) selected @endif>{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit">Simpan</button>
    </form>

    <script>
        // Memasukkan data dari variabel PHP $bidangs ke dalam JavaScript
        var bidangs = @json($bidangs); // Mengubah variabel PHP menjadi JSON untuk digunakan di JavaScript
        // Function untuk mengisi bidang dropdown berdasarkan departemen yang dipilih
        function getBidangs() {
            var departmentId = document.getElementById('id_departement').value;
            var bidangSelect = document.getElementById('id_bidang');
            bidangSelect.innerHTML = ''; // Menghapus opsi saat ini

            // Memfilter bidangs berdasarkan departmentId yang dipilih
            var filteredBidangs = bidangs.filter(function(bidang) {
                return bidang.id_departement == departmentId;
            });

            // Memasukkan opsi ke dropdown berdasarkan hasil filter
            filteredBidangs.forEach(function(bidang) {
                var option = document.createElement('option');
                option.value = bidang.id;
                option.textContent = bidang.nama_bidang;
                bidangSelect.appendChild(option);
            });
        }

    </script>
</body>

</html>
