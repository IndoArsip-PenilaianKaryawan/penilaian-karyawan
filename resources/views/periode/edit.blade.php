@extends('component.sidebar')
@section('content-admin')
<div class="px-4 py-8 xl:ml-80 bg-[#F5F6F7] min-h-screen">
    <div class="p-8 bg-white">
        <h1 class="font-semibold text-xl text-center mb-2">Tambah Periode</h1>
        <form action="{{ url("periode/{$periode->id}") }}" method="POST" class="gap-6 grid">
            @method('PATCH')
            @csrf
            <div class="gap-2 grid">
                <div class="font-semibold">Nama Periode</div>
                <input type="text" id="nama_periode" name="nama_periode" required value="{{ $periode->nama_periode }}" placeholder="Masukan Nama Periode" class="p-4 bg-[#E5E5E5]  rounded-2xl  text-sm w-full outline-0">
            </div>
            <div class="gap-2 grid">
                <div class="font-semibold">Tahun</div>
                <input type="text" id="tahun" name="tahun" required value="{{ $periode->tahun }}" placeholder="Masukan Tahun" class="p-4 bg-[#E5E5E5]  rounded-2xl  text-sm w-full outline-0">
            </div>
            <button type="submit" class="p-4 bg-[#9F2D2D]  rounded-2xl  text-sm w-full outline-0 text-white font-semibold">Simpan</button>
        </form>
    </div>
</div>
@endsection
