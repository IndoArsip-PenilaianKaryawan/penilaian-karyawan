<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    @include('component.sidebar2')
    <div class="px-4 py-8 xl:ml-80 bg-[#F5F6F7] min-h-screen">
        <div class="flex flex-row items-center mb-4">
            <h1 class="text-3xl font-semibold">Halaman Pengecekan</h1>
            <div class="gap-2 grid ml-4">
                <form action="{{ route('dashboard_penilai.periksa_filter') }}" method="POST">
                    @csrf
                    <div class="p-2 bg-[#E5E5E5] rounded-2xl text-sm w-full outline-0 flex items-center">
                        <select id="id_periode" name="id_periode" required placeholder="Masukan Periode" class="bg-transparent w-full outline-none">
                            @foreach ($periodes as $periode)
                            <option value="{{ $periode->id }}" {{ $periode_terpilih->id == $periode->id ? 'selected' : '' }}>
                                {{ $periode->nama_periode }}
                            </option>
                            @endforeach
                        </select>
                        <button type="submit" class="ml-2 px-4 py-2 text-black">Pilih</button>
                    </div>
                </form>
            </div>
        </div>

        @if (session('success'))
        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            {{ session('success') }}
        </div>
        @endif

        <h1 class="text-2xl font-semibold">Nilai {{$periode_terpilih->nama_periode}} </h1>
        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th>No Pegawai</th>
                    <th>Nama</th>
                    <th>Status Approval 1</th>
                    <th>Status Approval 2</th>
                    <th>Nilai 1</th>
                    <th>Nilai 2</th>
                    <th>Nilai 3</th>
                </tr>
            </thead>
            <tbody>
                @foreach($karyawans as $karyawan)
                <tr>
                    <td>{{ $karyawan->no_pegawai }}</td>
                    <td>{{ $karyawan->nama }}</td>
                    <td>
                        @if(isset($nilai_karyawan[$karyawan->id]['status_approval_1']))
                        {{ $nilai_karyawan[$karyawan->id]['status_approval_1'] }}
                        @else
                        Belum dinilai
                        @endif
                    </td>
                    <td>
                        @if(isset($nilai_karyawan[$karyawan->id]['status_approval_2']))
                        {{ $nilai_karyawan[$karyawan->id]['status_approval_2'] }}
                        @else
                        Belum dinilai
                        @endif
                    </td>
                    <td>
                        @if(isset($nilai_karyawan[$karyawan->id]['average']) && $nilai_karyawan[$karyawan->id]['average'] !== null)
                        {{ number_format($nilai_karyawan[$karyawan->id]['average'], 2) }}
                        @else
                        0.00
                        @endif
                    </td>
                    <td>
                        @if($nilai_karyawan[$karyawan->id]['id_approval_1'] === $user->id || $nilai_karyawan[$karyawan->id]['id_approval_1'] === $user->id)
                        @if(isset($nilai_karyawan[$karyawan->id]['average']) && $nilai_karyawan[$karyawan->id]['average'] > 0)
                        <a class="bg-yellow-200 text-yellow-700 px-2 py-1 rounded-full" href="{{ route('dashboard_penilai.editPeriksa', $karyawan->id) }}">UPDATE NILAI</a>
                        <a class="bg-green-200 text-green-700 px-2 py-1 rounded-full">ACC</a>
                        @else
                        <a class="bg-gray-200 text-gray-700 px-2 py-1 rounded-full">BELUM DINILAI</a>
                        @endif
                        @else
                        <a class="bg-gray-200 text-gray-700 px-2 py-1 rounded-full">ANDA BUKAN APPROVAL 1</a>
                        @endif
                    </td>
                    <td>
                        @if($nilai_karyawan[$karyawan->id]['id_approval_1'] === $user->id || $nilai_karyawan[$karyawan->id]['id_approval_2'] === $user->id)
                        @if(isset($nilai_karyawan[$karyawan->id]['average']) && $nilai_karyawan[$karyawan->id]['average'] > 0)
                        <a class="bg-yellow-200 text-yellow-700 px-2 py-1 rounded-full" href="{{ route('dashboard_penilai.editPeriksa', $karyawan->id) }}">UPDATE NILAI</a>
                        <a class="bg-green-200 text-green-700 px-2 py-1 rounded-full">ACC</a>
                        @else
                        <a class="bg-gray-200 text-gray-700 px-2 py-1 rounded-full">BELUM DINILAI</a>
                        @endif
                        @else
                        <a class="bg-gray-200 text-gray-700 px-2 py-1 rounded-full">ANDA BUKAN APPROVAL 2</a>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
