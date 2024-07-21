<!DOCTYPE html>
<html>

<head>
    <title>Daftar Karyawan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }


        table,
        th,
        td {
            border: 2px solid white;
            box-shadow: #E1E1E1 0px 2px 2px;
        }

        td {
            padding: 8px;
            text-align: center;
            background: white;
            font-size: 14px;
        }

        th {
            padding: 8px;
            text-align: center;
            background: #9F2D2D;
            color: white;
            font-size: 14px;
            font-weight: 500;
        }

        thead {
            background-color: #9F2D2D;
            color: white;
        }

        .table-container {
            width: 100%;
            height: fit-content;
            overflow-y: auto;
            overflow-x: auto;
        }
    </style>
    <script>
        function searchKaryawan() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("searchInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("karyawanTable");
            tr = table.getElementsByTagName("tr");

            for (i = 1; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1]; // Column index for Nama
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>
</head>

<body>
    @include ('component.sidebar')
    <div class="px-4 py-8 xl:ml-80 bg-[#F5F6F7] min-h-screen">
        <h1 class="text-xl md:text-3xl font-semibold ">Halaman Karyawan</h1>
        <div class="my-4 flex md:flex-row flex-col  w-full gap-2 "">
            <div class="flex justify-start md:w-1/3 ">
                <div class="p-2 md:p-4 bg-[#E5E5E5]  rounded-l-2xl flex  items-center text-xs md:text-sm w-full">
                    <i class="fas fa-search text-[#34364A]  pr-2"></i>
                    <input id="searchInput" class="bg-transparent outline-0 w-10/12" type="text"
                        placeholder="Cari Karyawan..." onkeyup="searchKaryawan()">
                </div>
                <button class="py-2 md:py-4 px-6 bg-[#9F2D2D] text-white rounded-r-2xl text-xs md:text-sm"
                    onclick="searchKaryawan()">
                    Cari
                </button>
            </div>
            <a class="bg-[#9F2D2D] text-white py-2 px-4 md:p-4  rounded-2xl text-xs md:text-sm ml:0 md:ml-4 w-fit"
                href="/karyawan/create"> <i class="fas fa-plus pr-2"></i> Tambah Karyawan</a>
        </div>

        @if (session('success'))
            <div>
                {{ session('success') }}
            </div>
        @endif

        <div class="table-container">
            <table border="1" id="karyawanTable">
                <thead>
                    <tr>
                        <th class="text-xs md:text-sm">ID</th>
                        <th class="text-xs md:text-sm">Nama</th>
                        <th class="text-xs md:text-sm">No Pegawai</th>
                        <th class="text-xs md:text-sm">Bidang</th>
                        <th class="text-xs md:text-sm">jabatan</th>
                        <th class="text-xs md:text-sm">atasan</th>
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
                            <td class="text-xs md:text-sm">{{ $karyawan->bidang ? $karyawan->bidang->nama_bidang : 'Tidak ada' }}</td>
                            <td class="text-xs md:text-sm">{{ $karyawan->jabatan->nama_jabatan }}</td>
                            <td class="text-xs md:text-sm">{{ $karyawan->atasan ? $karyawan->atasan->nama : 'Tidak ada' }}</td>
                            <td class="text-xs md:text-sm">{{ $karyawan->approval1 ? $karyawan->approval1->nama : 'Tidak ada' }}</td>
                            <td class="text-xs md:text-sm">{{ $karyawan->approval2 ? $karyawan->approval2->nama : 'Tidak ada' }}</td>
                            <td class="text-xs md:text-sm">
                                <a href=" {{ route('karyawan.edit', $karyawan->id) }}"
                                    class="bg-[#EBFFE9] text-[#2D9F46] px-2 py-1 rounded-full">EDIT</a>
                                <form action="{{ route('karyawan.destroy', $karyawan->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-[#FCE9FF] text-[#9F2D2D] px-2 py-1 rounded-full">HAPUS</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
