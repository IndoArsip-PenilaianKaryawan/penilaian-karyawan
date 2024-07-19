@extends('component.sidebar2')
@section('content-penilai')
<div class="px-4 py-8 xl:ml-80 bg-[#F5F6F7] min-h-screen">
    <div class="p-8 bg-white">
        <h1 class="font-semibold text-xl text-center mb-6">Input Nilai Karyawan {{$karyawan->nama}}</h1>
        <form action="{{ route('dashboard_penilai.store', $karyawan->id) }}" method="POST" class="gap-6 grid">
            @csrf

            <div class="p-4 bg-[#E5E5E5]  rounded-2xl  text-sm w-full outline-0">
                <select id="periode" name="id_periode" required placeholder="Masukan Jabatan" class="bg-transparent w-full outline-0">
                    @foreach ($periodes as $periode)
                    <option value="{{ $periode->id }}">{{ $periode->nama_periode }}</option>
                    @endforeach
                </select>
            </div>

            @foreach ($kompetensis as $index => $kompetensi)
            <div class="gap-4 mb-6 grid">
                <p class="font-semibold text-xl">{{ $kompetensi->nama_kompetensi }}</p>
                <div class="flex flex-wrap items-center gap-8">
                    <p class="font-semibold">Tidak baik</p>
                    <div class="grid w-[44rem] grid-cols-4 gap-2 rounded-xl bg-gray-200 p-2">
                        @for ($i = 1; $i <= 4; $i++) <div>
                            <input type="radio" name="indeks[{{ $index }}]" required value="{{ $i }}" id="option-{{$index}}-{{$i}}" class="peer hidden" checked />
                            <label for="option-{{$index}}-{{$i}}" class="block cursor-pointer select-none rounded-xl p-2 text-center peer-checked:bg-red-800 peer-checked:font-bold peer-checked:text-white text-lg"> {{ $i }}</label>
                    </div>
                    @endfor
                </div>
                <p class="font-semibold">Sangat baik</p>
            </div>
    </div>
    @endforeach

    <button type="submit" class="p-4 bg-[#9F2D2D] rounded-2xl text-sm w-full outline-0 text-white font-semibold">Tambah</button>
    </form>
</div>
</div>
@endsection

