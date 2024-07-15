<!DOCTYPE html>
<html>

<head>
    <title>Tambah Karyawan</title>
</head>

<body>
    @include('component.sidebar')
    <div class="px-4 py-8 xl:ml-80 bg-[#F5F6F7] min-h-screen">
        <div class="p-8 bg-white">
            <h1 class="font-semibold text-xl text-center">Tambah Karyawan</h1>
            <form action="{{ route('karyawan.store') }}" method="POST" class="gap-6 grid">
                @csrf
                <div class="gap-2 grid">
                    <div class="font-semibold">Nama</div>
                    <input type="text" id="nama" name="nama" required placeholder="Masukan Nama"
                        class="p-4 bg-[#E5E5E5]  rounded-2xl  text-sm w-full outline-0">
                </div>
                <div class="gap-2 grid">
                    <div class="font-semibold">No Pegawai</div>
                    <input type="text" id="no_pegawai" name="no_pegawai" required placeholder="Masukan No Pegawai"
                        class="p-4 bg-[#E5E5E5]  rounded-2xl  text-sm w-full outline-0">
                </div>

                <div class="gap-2 grid">
                    <div class="font-semibold">Departemen</div>
                    <div class="p-4 bg-[#E5E5E5]  rounded-2xl  text-sm w-full outline-0">
                        <select id="id_departement" name="id_departement" required placeholder="Masukan Departement"
                            class="bg-transparent w-full outline-0" onchange=getBidangs()>
                            @foreach ($departements as $departement)
                                <option value="{{ $departement->id }}">{{ $departement->nama_departement }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="gap-2 grid">
                    <div class="font-semibold">Bidang</div>
                    <div class="p-4 bg-[#E5E5E5]  rounded-2xl  text-sm w-full outline-0">
                        <select id="id_bidang" name="id_bidang" required placeholder="Masukan Bidang"
                            class="bg-transparent w-full outline-0">
                            @foreach ($bidangs as $bidang)
                                <option value="{{ $bidang->id }}">{{ $bidang->nama_bidang }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="gap-2 grid">
                    <div class="font-semibold">Jabatan</div>
                    <div class="p-4 bg-[#E5E5E5]  rounded-2xl  text-sm w-full outline-0">
                        <select id="id_jabatan" name="id_jabatan" required placeholder="Masukan Jabatan"
                            class="bg-transparent w-full outline-0">
                            @foreach ($jabatans as $jabatan)
                                <option value="{{ $jabatan->id }}">{{ $jabatan->nama_jabatan }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="gap-2 grid">
                    <div class="font-semibold">Atasan</div>
                    <div class="p-4 bg-[#E5E5E5]  rounded-2xl  text-sm w-full outline-0">
                        <select id="id_atasan" name="id_atasan" required placeholder="Masukan Atasan"
                            class="bg-transparent w-full outline-0">
                            @foreach ($karyawans as $karyawan)
                                <option value="{{ $karyawan->id }}">{{ $karyawan->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="gap-2 grid">
                    <div class="font-semibold">Approval 1</div>
                    <div class="p-4 bg-[#E5E5E5]  rounded-2xl  text-sm w-full outline-0">
                        <select id="id_approval_1" name="id_approval_1" required placeholder="Masukan Approval 1"
                            class="bg-transparent w-full outline-0">
                            @foreach ($karyawans as $karyawan)
                                <option value="{{ $karyawan->id }}">{{ $karyawan->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="gap-2 grid">
                    <div class="font-semibold">Approval 2</div>
                    <div class="p-4 bg-[#E5E5E5]  rounded-2xl  text-sm w-full outline-0">
                        <select id="id_approval_2" name="id_approval_2" required placeholder="Masukan Approval 2"
                            class="bg-transparent w-full outline-0">
                            @foreach ($karyawans as $karyawan)
                                <option value="{{ $karyawan->id }}">{{ $karyawan->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="gap-2 flex items-center">
                    <div class="font-semibold">Penilai</div>
                    <input type="checkbox" id="is_penilai" name="is_penilai"
                        class="h-4 w-4 text-[#9F2D2D] border-[#9F2D2D] rounded-full focus:ring-[#9F2D2D]">
                </div>
                <button type="submit"
                    class="p-4 bg-[#9F2D2D]  rounded-2xl  text-sm w-full outline-0 text-white font-semibold">Tambah</button>
            </form>
        </div>

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
    </div>
</body>

</html>
