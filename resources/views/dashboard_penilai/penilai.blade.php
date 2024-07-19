@extends('component.sidebar2')
@section('content-penilai')
<div class="px-4 py-8 xl:ml-80 bg-[#F5F6F7] min-h-screen">
    <div class="flex flex-row items-center mb-4">
        <h1 class="text-3xl font-semibold">Halaman Penilaian</h1>
        <div class="gap-2 grid ml-4">
            <form action="{{ route('dashboard_penilai.filter') }}" method="POST">
                @csrf
                <div class="p-2 bg-[#E5E5E5] rounded-2xl text-sm w-full outline-0 flex items-center">
                    <select id="id_periode" name="id_periode" required placeholder="Masukan Periode" class="bg-transparent w-full outline-none">
                        @foreach ($periodes as $periode)
                        <option value="{{ $periode->id }}" {{ $periode_terpilih->id == $periode->id ? 'selected' : '' }}>
                            {{ $periode->nama_periode }}
                        </option>
                        @endforeach
                    </select>
                    <button type="submit" class="ml-2 px-4 py-2 text-black">Pilih</button>
                </div>
            </form>
        </div>
    </div>

    @if (session('success'))
    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
        {{ session('success') }}
    </div>
    @endif

    <h1 class="text-2xl font-semibold">Nilai {{$periode_terpilih->nama_periode}} </h1>

    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>No Pegawai</th>
                <th>Nama</th>
                <th>Nama Bidang</th>
                <th>Indeks</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($karyawans as $karyawan)
            <tr>
                <td>{{ $karyawan->no_pegawai }}</td>
                <td>{{ $karyawan->nama }}</td>
                <td>{{ $karyawan->nama_bidang }}</td>
                <td>
                    @if(isset($nilai_karyawan[$karyawan->id]['average']) && $nilai_karyawan[$karyawan->id]['average'] !== null)
                    {{ number_format($nilai_karyawan[$karyawan->id]['average'], 2) }}
                    @else
                    0.00
                    @endif
                </td>
                <td>
                    @if ($nilai_karyawan[$karyawan->id]['status_approval_1'] != 'Approved')
                    @if(isset($nilai_karyawan[$karyawan->id]['average']) && $nilai_karyawan[$karyawan->id]['average'] > 0)
                    <a class="disabled bg-[#EBFFE9] text-[#2D9F46] px-2 py-1 rounded-full" href="{{ route('dashboard_penilai.edit', $karyawan->id) }}">UPDATE NILAI</a>
                    @else

                    <a class="disabled bg-[#EBFFE9] text-[#2D9F46] px-2 py-1 rounded-full" href="{{ route('dashboard_penilai.create', $karyawan->id) }}">NILAI</a>
                    @endif
                    @endif

                    <form action="{{ route('dashboard_penilai.destroy', $karyawan->id) }}" method="POST" style="display:inline;">
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
@endsection
