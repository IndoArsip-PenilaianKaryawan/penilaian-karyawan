@extends('component.sidebar')
@section('content-admin')
<div class="px-4 lg:py-8 py-4 xl:ml-80 bg-[#F5F6F7] min-h-screen">
    <div class="flex w-full flex-col  lg:mb-4 mb-8 gap-4">

        <h1 class="lg:text-3xl text-2xl font-semibold">Halaman Rekap</h1>
        <div class="flex ml-4">
            <form action="{{ route('rekap_nilai.filter') }}" method="POST" class="w-full">
                @csrf
                <div class="flex gap-2 items-center w-full">
                    <div class="p-3 bg-[#E5E5E5] rounded-2xl text-sm flex items-center w-full">
                        <select id="id_periode" name="id_periode" required class="bg-transparent w-full outline-none">
                            @foreach ($periodes as $periode)
                            <option class="w-full" value="{{ $periode->id }}" {{ $periode_terpilih->id == $periode->id ? 'selected' : '' }}>
                                {{ $periode->nama_periode }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="p-3 bg-[#E5E5E5] rounded-2xl text-sm flex items-center w-full">
                        <select id="id_cabang" name="id_cabang" required class="bg-transparent w-full outline-none">
                            <option value="all">All</option>
                            @foreach ($cabangs as $cabang)
                            <option class="w-full" value="{{ $cabang->id }}" {{ $id_cabang == $cabang->id ? 'selected' : '' }}>
                                {{ $cabang->nama }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="p-3 bg-[#E5E5E5]  rounded-2xl  text-sm w-full outline-0">
                        <select id="id_departement" name="id_departement" required class="bg-transparent w-full outline-0" onchange=getBidangs()>
                            <option value="all">All</option>
                            @foreach ($departements as $departement)
                            <option value="{{ $departement->id }}" {{ $id_departement == $departement->id ? 'selected' : '' }}>{{ $departement->nama_departement }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="p-3 bg-[#E5E5E5]  rounded-2xl  text-sm w-full outline-0">
                        <select id="id_bidang" name="id_bidang" required class="bg-transparent w-full outline-0">
                            <option value="all">All</option>
                            @foreach ($bidangs as $bidang)
                            <option value="{{ $bidang->id }}" {{ $id_bidang == $bidang->id ? 'selected' : '' }}>{{ $bidang->nama_bidang }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="ml-2 px-4 py-2 text-black">Pilih</button>
                    <button type="submit" name="action" value="export" class="focus:outline-none bg-red-700 font-medium rounded-lg text-sm px-5 py-2.5 text-white">Export Excel</button>
                </div>
            </form>
        </div>
    </div>

    @if (session('success'))
    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
        {{ session('success') }}
    </div>
    @endif

    <div class="flex justify-between items-center">
        <h1 class="lg:text-2xl text-xl font-semibold">Nilai {{$periode_terpilih->nama_periode}}</h1>
    </div>
    <div class="table-container">
        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th class="text-xs md:text-sm">Cabang</th>
                    <th class="text-xs md:text-sm">Departement</th>
                    <th class="text-xs md:text-sm">Bagian</th>
                    <th class="text-xs md:text-sm">No Pegawai</th>
                    <th class="text-xs md:text-sm">Nama</th>
                    <th class="text-xs md:text-sm">Nilai Akhir</th>
                </tr>
            </thead>
            <tbody class="border">
                @foreach($karyawans as $karyawan)
                <tr class="border">
                    <td class="text-xs md:text-sm">{{ $karyawan->cabang ? $karyawan->cabang->nama : 'Tidak ada' }}</td>
                    <td class="text-xs md:text-sm">{{$nilai_karyawan[$karyawan->id]['departement']}}</td>
                    <td class="text-xs md:text-sm">{{ $karyawan->bidang ? $karyawan->bidang->nama_bidang : 'Tidak ada' }}</td>
                    <td class="text-xs md:text-sm">{{ $karyawan->no_pegawai }}</td>
                    <td class="text-xs md:text-sm">{{ $karyawan->nama }}</td>
                    <td class="text-xs md:text-sm leading-normal">
                        @if ($nilai_karyawan[$karyawan->id]['status_approval_2'] == 'Approved')
                        <div class="flex justify-center items-center gap-2">
                            <p class="{{ $nilai_karyawan[$karyawan->id]['status_approval_2'] == 'Approved' ? 'text-green-600' : 'text-red-700' }}">
                                {{ number_format($nilai_karyawan[$karyawan->id]['nilai_approval_2'], 2) }}
                            </p>
                        </div>
                        @else
                        <a class="bg-gray-200 text-gray-700 px-2 py-1 text-xs rounded-full">ATASAN BELUM MENILAI</a>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    // Memasukkan data dari variabel PHP $bidangs ke dalam JavaScript
    var bidangs = @json($bidangs); // Mengubah variabel PHP menjadi JSON untuk digunakan di JavaScript
    // Function untuk mengisi bidang dropdown berdasarkan departemen yang dipilih
    function getBidangs() {
        var departmentId = document.getElementById('id_departement').value;
        var bidangSelect = document.getElementById('id_bidang');
        bidangSelect.innerHTML = '<option value="all">All</option>'; // Menghapus opsi saat ini dan menambahkan "All"

        // Memfilter bidangs berdasarkan departmentId yang dipilih
        if (departmentId !== "all") {
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
    }
</script>
@endsection
