@extends('component.sidebar')
@section('content-admin')
<div class="px-4 py-8 xl:ml-80 bg-[#F5F6F7] min-h-screen">
    <div class="flex flex-row items-center mb-4">
        <h1 class="text-3xl font-semibold">Halaman Kompetensi</h1>
        <a class="bg-[#9F2D2D] text-white p-4  rounded-2xl text-sm ml-4" href="/kompetensi/create"> <i class="fas fa-plus pr-2"></i> Tambah Kompetensi</a>
    </div>

    @if (session('success'))
    <div>
        {{ session('success') }}
    </div>
    @endif

    <table border="1" id="kompetensiTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Kompetensi</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kompetensi as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->nama_kompetensi }}</td>
                <td>{{ $item->deskripsi }}</td>
                <td>
                    <a href="{{ route('kompetensi.edit', $item->id) }}" class="bg-[#EBFFE9] text-[#2D9F46] px-2 py-1 rounded-full">EDIT</a>
                    <form action="{{ route('kompetensi.destroy', $item->id) }}" method="POST" style="display:inline;">
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
