<!DOCTYPE html>
<html>

<head>
    <title>Create Kompetensi</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>


<body>
    @include('component.sidebar')
    <div class="px-4 py-8 xl:ml-80 bg-[#F5F6F7] min-h-screen">
        <div class="p-8 bg-white">
            <h1 class="font-semibold text-xl text-center">Tambah Kompetensi</h1>
            <form action="{{ route('kompetensi.store') }}" method="POST" class="gap-6 grid">
                @csrf
                <div class="gap-2 grid">
                    <div class="font-semibold">Nama Kompetensi:</div>
                    <input type="text" id="nama_kompetensi" name="nama_kompetensi" required placeholder="Masukan Nama Kompetensi" class="p-4 bg-[#E5E5E5]  rounded-2xl  text-sm w-full outline-0">
                </div>
                <div class="gap-2 grid">
                    <div class="font-semibold">Deskripsi:</div>
                    <input type="text" id="deskripsi" name="deskripsi" placeholder="Masukan deskripsi kompetensi" class="p-4 bg-[#E5E5E5]  rounded-2xl  text-sm w-full outline-0">
                </div>

                <button type="submit" class="p-4 bg-[#9F2D2D]  rounded-2xl  text-sm w-full outline-0 text-white font-semibold">Tambah</button>
            </form>
        </div>

        <script>
        </script>
    </div>
</body>

</html>
