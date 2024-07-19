<!DOCTYPE html>
<html>

<head>
    <title>Update Nilai</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <style>
        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 100;
            left: 0;
            top: 0;
            width: 100%;
            height: max-content;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: white;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 500px;
            border-radius: 10px;
            text-align: center;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>

<body>
    @include('component.sidebar2')
    <div class="px-4 py-8 xl:ml-80 bg-[#F5F6F7] min-h-screen">
        <div class="p-8 bg-white">
            <h1 class="font-semibold text-xl text-center mb-6">Update Nilai Karyawan {{ $namaKaryawan->nama }}</h1>
            <form id="updateForm" action="{{ route('dashboard_penilai.updatePeriksaNilai1', $karyawan->id_karyawan) }}" method="POST" class="gap-6 grid">
                @csrf
                @method('PATCH')
                <div class="p-4 bg-[#E5E5E5] rounded-2xl text-sm w-full outline-0">
                    <select id="id_periode" name="id_periode" required placeholder="Masukan Jabatan" class="bg-transparent w-full outline-0">
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
                                <input type="radio" name="nilai_approval_1[{{ $index }}]" required value="{{ $i }}" id="option-{{$index}}-{{$i}}" class="peer hidden" @if (old('nilai_approval_1.' . $index, $karyawan->nilai_approval_1[$index] ?? '') == $i) checked @endif/>
                                <label for="option-{{$index}}-{{$i}}" class="block cursor-pointer select-none rounded-xl p-2 text-center peer-checked:bg-red-800 peer-checked:font-bold peer-checked:text-white text-lg"> {{ $i }}</label>
                        </div>
                        @endfor
                    </div>
                    <p class="font-semibold">Sangat baik</p>
                </div>
        </div>
        @endforeach

        <button type="button" class="p-4 bg-[#9F2D2D] rounded-2xl text-sm w-full outline-0 text-white font-semibold" id="updateButton">Update data</button>
        </form>
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
                            Mengupdate Nilai Karyawan
                        </h3>
                        <div class="mt-2">
                            <p class="text-lg text-gray-500">
                                Apakah anda setuju untuk mengupdate nilai karyawan, ketika diupdate nilai tidak bisa mengubah kembali
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
        var btn = document.getElementById("updateButton");
        var span = document.getElementsByClassName("close")[0];
        var confirmBtn = document.getElementById("confirmUpdate");
        var cancelBtn = document.getElementById("cancelUpdate");
        btn.onclick = function() {
            modal.style.display = "block";
        }
        span.onclick = function() {
            modal.style.display = "none";
        }
        cancelBtn.onclick = function() {
            modal.style.display = "none";
        }
        confirmBtn.onclick = function() {
            document.getElementById("updateForm").submit();
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
</body>

</html>
