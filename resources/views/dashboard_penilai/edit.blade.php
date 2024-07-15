<!DOCTYPE html>
<html>

<head>
    <title>Update Nilai</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>

<body>
    @include('component.sidebar2')
    <div class="px-4 py-8 xl:ml-80 bg-[#F5F6F7] min-h-screen">
        <div class="p-8 bg-white">
            <h1 class="font-semibold text-xl text-center mb-6">Update Nilai Karyawan {{ $namaKaryawan->nama }}</h1>
            <form action="{{ route('dashboard_penilai.update', $karyawan->id_karyawan) }}" method="POST" class="gap-6 grid">
                @csrf
                @method('PATCH')
                <div class="p-4 bg-[#E5E5E5]  rounded-2xl  text-sm w-full outline-0">
                    <select id="id_periode" name="id_periode" required placeholder="Masukan Jabatan" class="bg-transparent w-full outline-0">
                        @foreach ($periodes as $periode)
                        <option value="{{ $periode->id }}">{{ $periode->nama_periode }}</option>
                        @endforeach
                    </select>
                </div>

                @foreach ($kompetensis as $index => $kompetensi)
                <div class="gap-2 grid">
                    <div class="font-semibold">{{ $kompetensi->nama_kompetensi }}</div>
                    <div class="flex flex-wrap gap-14">
                        @for ($i = 1; $i <= 4; $i++) <label class="flex items-center gap-2">
                            <input type="radio" name="indeks[{{ $index }}]" required value="{{ $i }}" @if (old('indeks.' . $index, $karyawan->indeks[$index] ?? '') == $i) checked @endif
                            class="p-4 bg-[#E5E5E5] rounded-2xl text-sm outline-0">
                            {{ $i }}
                            </label>
                            @endfor
                    </div>
                </div>
                @endforeach

                <button type="submit" class="p-4 bg-[#9F2D2D] rounded-2xl text-sm w-full outline-0 text-white font-semibold">Update data</button>
            </form>
        </div>
    </div>
</body>

</html>
