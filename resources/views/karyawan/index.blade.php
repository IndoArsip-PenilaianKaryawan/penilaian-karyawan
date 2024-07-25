@extends('component.sidebar')
@section('content-admin')
<div class="px-4 py-8 xl:ml-80 bg-[#F5F6F7] min-h-screen">
    <h1 class="text-xl md:text-3xl font-semibold ">Halaman Karyawan</h1>
    <form action="{{ url('/karyawan') }}">
        <div class="my-4 flex md:flex-row flex-col  w-full gap-2 "">
                <div class=" flex justify-start md:w-1/3 ">
                    <div class=" p-2 md:p-4 bg-[#E5E5E5] rounded-l-2xl flex items-center text-xs md:text-sm w-full">
            <i class="fas fa-search text-[#34364A]  pr-2"></i>
            <input id="searchInput" class="bg-transparent outline-0 w-10/12" type="text" placeholder="Cari Karyawan..." name="search" value="{{ request('search') }}">
        </div>
        <button type="submit" class="py-2 md:py-4 px-6 bg-[#9F2D2D] text-white rounded-r-2xl text-xs md:text-sm"">
                        Cari
                    </button>
        </form>
    </div>
    <a class=" bg-[#9F2D2D] text-white py-2 px-4 md:p-4 rounded-2xl text-xs md:text-sm ml:0 md:ml-4 w-fit" href="/karyawan/create"> <i class="fas fa-plus pr-2"></i> Tambah Karyawan</a>
</div>

@if (session('success'))
<div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
    {{ session('success') }}
</div>
@endif

<div class="table-container">
    <table border="1" id="karyawanTable">
        <thead>
            <tr>
                <th class="text-xs md:text-sm">No</th>
                <th class="text-xs md:text-sm">Nama</th>
                <th class="text-xs md:text-sm">No Pegawai</th>
                <th class="text-xs md:text-sm">Cabang</th>
                <th class="text-xs md:text-sm">Jabatan</th>
                <th class="text-xs md:text-sm">Bidang</th>
                <th class="text-xs md:text-sm">Atasan</th>
                <th class="text-xs md:text-sm">Approval 1</th>
                <th class="text-xs md:text-sm">Approval 2</th>
                <th class="text-xs md:text-sm">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($karyawans as $karyawan)
            <tr>
                <td class="text-xs md:text-sm">{{ $karyawan->id }}</td>
                <td class="text-xs md:text-sm">{{ $karyawan->nama }}</td>
                <td class="text-xs md:text-sm">{{ $karyawan->no_pegawai }}</td>
                <td class="text-xs md:text-sm">{{ $karyawan->cabang ? $karyawan->cabang->nama : 'Tidak ada' }}</td>
                <td class="text-xs md:text-sm">{{ $karyawan->jabatan->nama_jabatan }}</td>
                <td class="text-xs md:text-sm">
                    {{ $karyawan->bidang ? $karyawan->bidang->nama_bidang : 'Tidak ada' }}
                </td>
                <td class="text-xs md:text-sm">{{ $karyawan->atasan ? $karyawan->atasan->nama : 'Tidak ada' }}</td>
                <td class="text-xs md:text-sm">{{ $karyawan->approval1 ? $karyawan->approval1->nama : 'Tidak ada' }}
                </td>
                <td class="text-xs md:text-sm">
                    {{ $karyawan->approval2 ? $karyawan->approval2->nama : 'Tidak ada' }}
                </td>
                <td class="text-xs md:text-sm">
                    <a href=" {{ route('karyawan.edit', $karyawan->id) }}" class="bg-[#EBFFE9] text-[#2D9F46] px-2 py-1 rounded-full">EDIT</a>
                    <form id="updateForm" action="{{ route('karyawan.destroy', $karyawan->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button data-id="{{$karyawan->id}}" id="updateButton-{{$karyawan->id}}" type="button" class="bg-[#FCE9FF] text-[#9F2D2D] px-2 py-1 rounded-full delete-button">HAPUS</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $karyawans->links() }}
</div>
</div>

<!-- Modal -->
<div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
            <div class="sm:flex sm:items-start">
                <div class="mx-auto flex h-14 w-14 flex-shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                    <svg aria-hidden="true" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" fill="none" class="h-6 w-6 text-red-600">
                        <path d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" stroke-linejoin="round" stroke-linecap="round"></path>
                    </svg>
                </div>
                <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                    <h3 id="modal-title" class="text-xl font-semibold leading-6 text-gray-900">
                        Menghapus data
                    </h3>
                    <div class="mt-2">
                        <p class="text-lg text-gray-500">
                            Apakah anda setuju untuk menghapus data, ketika dihapus maka data akan dihapus permanen
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex justify-end mt-4">
            <button id="confirmUpdate" class="focus:outline-none bg-red-800 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 text-white">Hapus data</button>
            <button id="cancelUpdate" class="focus:outline-none bg-gray-400 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 text-gray-600">Batalkan</button>
        </div>
    </div>
</div>

<script>
    var modal = document.getElementById("myModal");
    var span = document.getElementsByClassName("close")[0];
    var confirmBtn = document.getElementById("confirmUpdate");
    var cancelBtn = document.getElementById("cancelUpdate");

    // Select all delete buttons
    var deleteButtons = document.querySelectorAll(".delete-button");

    deleteButtons.forEach(function(btn) {
        btn.onclick = function() {
            var karyawanId = this.getAttribute("data-id");
            modal.style.display = "block";

            confirmBtn.onclick = function() {
                var form = document.querySelector("form[action='{{ route('karyawan.destroy', '') }}/" + karyawanId + "']");
                if (form) {
                    form.submit();
                }
            };
        };
    });

    span.onclick = function() {
        modal.style.display = "none";
    }
    cancelBtn.onclick = function() {
        modal.style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>


@endsection
