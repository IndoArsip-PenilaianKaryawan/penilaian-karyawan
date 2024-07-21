@extends('component.sidebar2')
@section('content-penilai')
<div class="px-4 lg:py-8 py-4 xl:ml-80 bg-[#F5F6F7] min-h-screen">


    <div class="flex w-full lg:flex-row flex-col items-center lg:mb-4 mb-8 gap-4">
        <h1 class="lg:text-3xl text-2xl font-semibold">Halaman Pengecekan</h1>
        <div class="flex ml-4">
            <form action="{{ route('dashboard_penilai.periksa_filter') }}" method="POST" class="w-full">
                @csrf
                <div class="flex gap-4 items-center w-full">
                    <div class="p-2 bg-[#E5E5E5] rounded-2xl text-sm flex items-center w-full">
                        <select id="id_periode" name="id_periode" required class="bg-transparent w-full outline-none">
                            @foreach ($periodes as $periode)
                            <option class="w-full" value="{{ $periode->id }}" {{ $periode_terpilih->id == $periode->id ? 'selected' : '' }}>
                                {{ $periode->nama_periode }}
                            </option>
                            @endforeach
                        </select>
                        <button type="submit" class="ml-2 px-4 py-2 text-black">Pilih</button>
                    </div>

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
        <h1 class="lg:text-2xl text-xl font-semibold">Nilai {{$periode_terpilih->nama_periode}} </h1>
    </div>
    <div class="table-container">
        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th class="text-xs md:text-sm">No Pegawai</th>
                    <th class="text-xs md:text-sm">Nama</th>
                    <th class="text-xs md:text-sm">Status Approval 1</th>
                    <th class="text-xs md:text-sm">Status Approval 2</th>
                    <th class="text-xs md:text-sm">Nilai 1</th>
                    <th class="text-xs md:text-sm">Nilai 2</th>
                    <th class="text-xs md:text-sm">Nilai 3</th>
                </tr>
            </thead>
            <tbody>
                @foreach($karyawans as $karyawan)
                <tr>
                    <td class="text-xs md:text-sm">{{ $karyawan->no_pegawai }}</td>
                    <td class="text-xs md:text-sm">{{ $karyawan->nama }}</td>
                    <td class="text-xs md:text-sm">
                        @if(isset($nilai_karyawan[$karyawan->id]['status_approval_1']))
                        {{ $nilai_karyawan[$karyawan->id]['status_approval_1'] }}
                        @else
                        Belum Ada Nilai
                        @endif
                    </td>
                    <td class="text-xs md:text-sm">
                        @if(isset($nilai_karyawan[$karyawan->id]['status_approval_2']))
                        {{ $nilai_karyawan[$karyawan->id]['status_approval_2'] }}
                        @else
                        Belum Ada Nilai
                        @endif
                    </td>
                    <td class="text-xs md:text-sm">
                        @if(isset($nilai_karyawan[$karyawan->id]['average']) && $nilai_karyawan[$karyawan->id]['average'] !== null)
                        {{ number_format($nilai_karyawan[$karyawan->id]['average'], 2) }}
                        @else
                        0.00
                        @endif
                    </td>
                    <td class="text-xs md:text-sm leading-normal">
                        <!-- jika user merupakan approval -->
                        @if($nilai_karyawan[$karyawan->id]['id_approval_1'] === $user->id )

                        <!-- jika nilai approval ada dan tidak kosong -->
                        @if(isset($nilai_karyawan[$karyawan->id]['nilai_approval_1']) && $nilai_karyawan[$karyawan->id]['nilai_approval_1'] > 0)
                        <div class="flex justify-center items-center gap-2">
                            <p class="{{ $nilai_karyawan[$karyawan->id]['status_approval_1'] == 'Approved' ? 'text-green-600' : 'text-red-700' }}">
                                {{ number_format($nilai_karyawan[$karyawan->id]['nilai_approval_1'], 2) }}
                            </p>
                            <!-- jika status sudah di approved -->
                            @if ($nilai_karyawan[$karyawan->id]['status_approval_1'] != 'Approved')
                            <div class="flex gap-1">
                                <a class="bg-yellow-200 text-xs text-yellow-700 px-2 py-1 rounded-full" href="{{ route('dashboard_penilai.editPeriksaNilai1', $karyawan->id) }}">UPDATE</a>
                                <a class="bg-green-200 text-xs text-green-600 px-2 py-1 rounded-full" href="{{ route('dashboard_penilai.accnilai1', $karyawan->id) }}">ACC</a>
                            </div>
                            @endif
                        </div>
                        @else
                        <a class="bg-gray-200 text-gray-700 px-2 py-1 text-xs rounded-full">BELUM ADA NILAI</a>
                        @endif
                        @else
                        <div class="flex flex-col justify-center items-center gap-2">
                            <p class="{{ $nilai_karyawan[$karyawan->id]['status_approval_1'] == 'Approved' ? 'text-green-600' : 'text-red-500' }}">
                                {{ number_format($nilai_karyawan[$karyawan->id]['nilai_approval_1'], 2) }}
                            </p>
                            <a class="bg-gray-200 text-gray-700 text-xs px-2 py-1 rounded-full">APPROVAL 1</a>
                        </div>

                        @endif
                    </td>
                    <td class="text-xs md:text-sm leading-normal">
                        <!-- jika user merupakan approval -->
                        @if($nilai_karyawan[$karyawan->id]['id_approval_2'] === $user->id)

                        <!-- jika nilai approval ada dan tidak kosong -->
                        @if(isset($nilai_karyawan[$karyawan->id]['nilai_approval_2']) && $nilai_karyawan[$karyawan->id]['nilai_approval_2'] > 0)
                        @if ($nilai_karyawan[$karyawan->id]['status_approval_1'] == 'Approved')
                        <div class="flex justify-center items-center gap-2">
                            <p class="{{ $nilai_karyawan[$karyawan->id]['status_approval_2'] == 'Approved' ? 'text-green-600' : 'text-red-700' }}">
                                {{ number_format($nilai_karyawan[$karyawan->id]['nilai_approval_2'], 2) }}
                            </p>
                            <!-- jika status sudah di approved -->
                            @if ($nilai_karyawan[$karyawan->id]['status_approval_2'] != 'Approved')
                            <div class="flex gap-1">
                                <a class="bg-yellow-200 text-xs text-yellow-700 px-2 py-1 rounded-full" href="{{ route('dashboard_penilai.editPeriksaNilai2', $karyawan->id) }}">UPDATE</a>
                                <a class="bg-green-200 text-xs text-green-700 px-2 py-1 rounded-full" href="{{ route('dashboard_penilai.accnilai2', $karyawan->id) }}">ACC</a>
                            </div>
                            @endif
                        </div>
                        @else
                        <a class="bg-gray-200 text-gray-700 px-2 py-1 text-xs rounded-full">MENUNGGU APPROVAL 1 ACC</a>
                        @endif

                        @else
                        <a class="bg-gray-200 text-gray-700 px-2 py-1 text-xs rounded-full">BELUM ADA NILAI</a>
                        @endif

                        @else
                        <div class="flex flex-col justify-center items-center gap-2">
                            <p>
                                {{ number_format($nilai_karyawan[$karyawan->id]['nilai_approval_2'], 2) }}
                            </p>
                            <a class="bg-gray-200 text-gray-700 text-xs px-2 py-1 rounded-full">APPROVAL 2</a>
                        </div>

                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
