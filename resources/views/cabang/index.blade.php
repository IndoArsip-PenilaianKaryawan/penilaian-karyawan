@extends('component.sidebar')
@section('content-admin')
<div class="px-4 py-8 xl:ml-80 bg-[#F5F6F7] min-h-screen">
    <div class="flex flex-col md:flex-row md:items-center mb-4">
        <h1 class="text-xl md:text-3xl font-semibold">Halaman Cabang</h1>
        <a class="bg-[#9F2D2D] text-white md:p-4 p-2 w-fit rounded-2xl text-sm md:ml-4" href="/cabang/create"> <i class="fas fa-plus pr-2"></i> Tambah Cabang</a>
    </div>

    @if (session('success'))
    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
        {{ session('success') }}
    </div>
    @endif

    <table border="1" id="cabangTable">
        <thead>
            <tr>
                <th class="text-xs md:text-sm">ID</th>
                <th class="text-xs md:text-sm">Nama Cabang</th>
                <th class="text-xs md:text-sm">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cabang as $item)
            <tr>
                <td class="text-xs md:text-sm">{{ $item->id }}</td>
                <td class="text-xs md:text-sm">{{ $item->nama }}</td>
                <td class="text-xs md:text-sm flex flex-col md:flex-row md:py-1 md:gap-2 py-4 gap-4 h-full justify-between md:justify-center">
                    <a href="{{ route('cabang.edit', $item->id) }}" class="bg-[#EBFFE9] text-[#2D9F46] px-2 py-1 rounded-full">EDIT</a>
                    <form action="{{ route('cabang.destroy', $item->id) }}" method="POST" style="display:inline;">
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
