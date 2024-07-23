<?php

namespace App\Exports;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\DB;
use App\Models\M_karyawan;
use App\Models\M_periode;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class KaryawanExport
{
    public function export(Request $request)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set header
        $sheet->setCellValue('A1', 'No Pegawai');
        $sheet->setCellValue('B1', 'Nama');
        $sheet->setCellValue('C1', 'Status Approval 1');
        $sheet->setCellValue('D1', 'Status Approval 2');
        $sheet->setCellValue('E1', 'Nilai 1');
        $sheet->setCellValue('F1', 'Nilai 2');
        $sheet->setCellValue('G1', 'Nilai 3');

        
        $user = Auth::guard('user')->user();

        if ($user) {
            $id_periode = $request->input('id_periode'); // Ambil id_periode yang dipilih dari form

            // Jika id_periode belum dipilih, ambil periode terbaru
            if (!$id_periode) {
                $periode_terbaru = M_periode::orderBy('created_at', 'desc')->first();

                if (!$periode_terbaru) {
                    return redirect()->back()->withErrors(['msg' => 'No periode available']);
                }

                $id_periode = $periode_terbaru->id;
            }

            // Ambil data karyawan berdasarkan periode yang dipilih
            $karyawans = M_karyawan::join('m_bidang', 'm_karyawan.id_bidang', '=', 'm_bidang.id')
            ->where(function ($query) use ($user) {
                $query->where('m_karyawan.id_approval_1', $user->id)
                ->orWhere('m_karyawan.id_approval_2', $user->id);
            })
                ->select('m_karyawan.*', 'm_karyawan.no_pegawai', 'm_bidang.nama_bidang')
                ->get();

            // Mengambil data nilai karyawan
            $nilai_karyawan = [];
            // Ambil data nilai berdasarkan periode yang dipilih
            $nilai_karyawan = [];
            foreach ($karyawans as $karyawan) {
                // Menggunakan raw query untuk menghitung rata-rata dari array JSON
                $average = DB::table('m_nilai')
                    ->select(DB::raw("
                    AVG(CAST(JSON_UNQUOTE(JSON_EXTRACT(JSON_EXTRACT(indeks, CONCAT('$[', numbers.i, ']')), '$')) AS UNSIGNED)) AS rata_rata_indeks
                "))
                    ->crossJoin(DB::raw("(SELECT 0 i UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9) numbers"))
                    ->where('id_karyawan', $karyawan->id)
                    ->where('id_periode', $id_periode)
                    ->whereRaw("JSON_EXTRACT(indeks, CONCAT('$[', numbers.i, ']')) IS NOT NULL")
                    ->groupBy('id_karyawan', 'id_periode')
                    ->value('rata_rata_indeks');

                // nilai approval 1
                $nilai_approval_1 = DB::table('m_nilai')
                    ->select(DB::raw("
                    AVG(CAST(JSON_UNQUOTE(JSON_EXTRACT(JSON_EXTRACT(nilai_approval_1, CONCAT('$[', numbers.i, ']')), '$')) AS UNSIGNED)) AS rata_rata_nilai_approval_1
                "))
                    ->crossJoin(DB::raw("(SELECT 0 i UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9) numbers"))
                    ->where('id_karyawan', $karyawan->id)
                    ->where('id_periode', $id_periode)
                    ->whereRaw("JSON_EXTRACT(indeks, CONCAT('$[', numbers.i, ']')) IS NOT NULL")
                    ->groupBy('id_karyawan', 'id_periode')
                    ->value('rata_rata_nilai_approval_1');


                // nilai approval 2
                $nilai_approval_2 = DB::table('m_nilai')
                    ->select(DB::raw("
                    AVG(CAST(JSON_UNQUOTE(JSON_EXTRACT(JSON_EXTRACT(nilai_approval_2, CONCAT('$[', numbers.i, ']')), '$')) AS UNSIGNED)) AS rata_rata_nilai_approval_2
                "))
                    ->crossJoin(DB::raw("(SELECT 0 i UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9) numbers"))
                    ->where('id_karyawan', $karyawan->id)
                    ->where('id_periode', $id_periode)
                    ->whereRaw("JSON_EXTRACT(indeks, CONCAT('$[', numbers.i, ']')) IS NOT NULL")
                    ->groupBy('id_karyawan', 'id_periode')
                    ->value('rata_rata_nilai_approval_2');

                // Ambil data status approval
                $nilai = DB::table('m_nilai')
                    ->select('indeks', 'status_approval_1', 'status_approval_2')
                    ->where('id_karyawan', $karyawan->id)
                    ->where('id_periode', $id_periode)
                    ->first();

                if ($nilai) {
                    $nilai_karyawan[$karyawan->id] = [
                        'average' => $average,
                        'nilai_approval_1' => $nilai_approval_1,
                        'nilai_approval_2' => $nilai_approval_2,
                        'status_approval_1' => $nilai->status_approval_1,
                        'status_approval_2' => $nilai->status_approval_2,
                        'id_approval_1' => $karyawan->id_approval_1,
                        'id_approval_2' => $karyawan->id_approval_2,
                    ];
                } else {
                    $nilai_karyawan[$karyawan->id] = [
                        'average' => $average,
                        'nilai_approval_1' => $nilai_approval_1,
                        'nilai_approval_2' => $nilai_approval_2,
                        'status_approval_1' => null,
                        'status_approval_2' => null,
                        'id_approval_1' => $karyawan->id_approval_1,
                        'id_approval_2' => $karyawan->id_approval_2,
                    ];
                }
            }

            // Fill data
            $row = 2;
            foreach ($karyawans as $karyawan) {
                $sheet->setCellValue('A' . $row, $karyawan->no_pegawai);
                $sheet->setCellValue('B' . $row, $karyawan->nama);
                $sheet->setCellValue('C' . $row, isset($nilai_karyawan[$karyawan->id]['status_approval_1']) ? $nilai_karyawan[$karyawan->id]['status_approval_1'] : 'Belum dinilai');
                $sheet->setCellValue('D' . $row, isset($nilai_karyawan[$karyawan->id]['status_approval_2']) ? $nilai_karyawan[$karyawan->id]['status_approval_2'] : 'Belum dinilai');
                $sheet->setCellValue('E' . $row, isset($nilai_karyawan[$karyawan->id]['average']) ? number_format($nilai_karyawan[$karyawan->id]['average'], 2) : '0.00');
                $sheet->setCellValue('F' . $row, isset($nilai_karyawan[$karyawan->id]['average']) ? number_format($nilai_karyawan[$karyawan->id]['nilai_approval_1'], 2) : '0.00');
                $sheet->setCellValue('G' . $row, isset($nilai_karyawan[$karyawan->id]['average']) ? number_format($nilai_karyawan[$karyawan->id]['nilai_approval_2'], 2) : '0.00');
                // Tambahkan nilai lain sesuai kebutuhan
                $row++;
            }


            $periodeTerpilih = M_periode::where('id', $id_periode)->first();

            // Write to file
            $writer = new Xlsx($spreadsheet);
            $fileName = "$periodeTerpilih->nama_periode, $periodeTerpilih->tahun .xlsx";
            $filePath = storage_path('app/public/' . $fileName);
            $writer->save($filePath);

            return response()->download($filePath)->deleteFileAfterSend(true);
        }

        return redirect()->back()->withErrors(['msg' => 'User not authenticated']);
    }
}
