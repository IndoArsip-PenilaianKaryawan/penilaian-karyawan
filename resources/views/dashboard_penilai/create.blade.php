<!DOCTYPE html>
<html>

<head>
    <title>Add Nilai</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>

<body>
    @include('component.sidebar2')
    <div class="px-4 py-8 xl:ml-80 bg-[#F5F6F7] min-h-screen">
        <div class="p-8 bg-white">
            <h1 class="font-semibold text-xl text-center">Input Nilai</h1>
            <form action="{{ route('dashboard_penilai.store', $karyawan->id) }}" method="POST" class="gap-6 grid">
                @csrf
                @method('PATCH')
                <input type="hidden" name="id_periode" value="1"> <!-- Sesuaikan dengan periode yang sesuai -->

                @foreach ($kompetensis as $kompetensi)
                <div class="gap-2 grid">
                    <div class="font-semibold">{{ $kompetensi->nama_kompetensi }}</div>
                    <input type="hidden" name="id_kompetensi[]" value="{{ $kompetensi->id }}">
                    <input type="number" name="indeks[]" required value="{{ old('indeks.' . $loop->index, $karyawan->indeks[$loop->index] ?? '') }}" placeholder="Masukkan nilai untuk {{ $kompetensi->nama_kompetensi }}" class="p-4 bg-[#E5E5E5] rounded-2xl text-sm w-full outline-0">
                </div>
                @endforeach
                <button type="submit" class="p-4 bg-[#9F2D2D] rounded-2xl text-sm w-full outline-0 text-white font-semibold">Tambah</button>
            </form>
        </div>
    </div>
</body>

</html>
