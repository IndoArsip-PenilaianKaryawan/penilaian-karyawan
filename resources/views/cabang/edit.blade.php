@extends('component.sidebar')
@section('content-admin')

<div class="px-4 py-8 xl:ml-80 bg-[#F5F6F7] min-h-screen">
    <div class="p-8 bg-white">
        <h1 class="font-semibold text-xl text-center mb-2">Update Cabang</h1>
        <form action="{{url("cabang/{$cabang->id}")}}" method="POST" class="gap-6 grid">
            @method('PATCH')
            @csrf
            <div class="gap-2 grid">
                <div class="font-semibold">Nama Cabang:</div>
                <input type="text" id="nama" name="nama" required value="{{$cabang->nama}}" class="p-4 bg-[#E5E5E5]  rounded-2xl  text-sm w-full outline-0">
            </div>

            <button type="submit" class="p-4 bg-[#9F2D2D]  rounded-2xl  text-sm w-full outline-0 text-white font-semibold">Update</button>
        </form>
    </div>
</div>
@endsection
