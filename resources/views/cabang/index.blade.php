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
                <th class="text-xs md:text-sm">Nama Cabang</th>
                <th class="text-xs md:text-sm">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cabang as $item)
            <tr>
                <td class="text-xs md:text-sm">{{ $item->nama }}</td>
                <td class="text-xs md:text-sm flex flex-col md:flex-row md:py-1 md:gap-2 py-4 gap-4 h-full justify-between md:justify-center">
                    <a href="{{ route('cabang.edit', $item->id) }}" class="bg-[#EBFFE9] text-[#2D9F46] px-2 py-1 rounded-full">EDIT</a>
                    <form action="{{ route('cabang.destroy', $item->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button data-id="{{$item->id}}" id="updateButton-{{$item->id}}" type="button" class="bg-[#FCE9FF] text-[#9F2D2D] px-2 py-1 rounded-full delete-button">HAPUS</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $cabang->links() }}
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
                        Mengupdate Nilai Karyawan
                    </h3>
                    <div class="mt-2">
                        <p class="text-lg text-gray-500">
                            Apakah anda setuju untuk mengupdate nilai karyawan, ketika diupdate nilai tidak bisa diubah kembali
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <button id="confirmUpdate" class="focus:outline-none bg-red-800 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 text-white">Setuju, Ubah</button>
        <button id="cancelUpdate" class="focus:outline-none bg-gray-400 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 text-gray-600">Batalkan</button>
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
            var cabangId = this.getAttribute("data-id");
            modal.style.display = "block";

            confirmBtn.onclick = function() {
                var form = document.querySelector("form[action='{{ route('cabang.destroy', '') }}/" + cabangId + "']");
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
