<?php

namespace App\Exports;

use App\Models\M_bidang;
use App\Models\M_cabang;
use App\Models\M_departement;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\DB;
use App\Models\M_karyawan;
use App\Models\M_periode;
use Illuminate\Http\Request;

class RekapExport
{
    public function export(Request $request)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // set header
        $sheet->setCellValue('A1', 'Cabang');
        $sheet->setCellValue('B1', 'Departemen');
        $sheet->setCellValue('C1', 'Bagian');
        $sheet->setCellValue('D1', 'No Pegawai');
        $sheet->setCellValue('E1', 'Nama');
        $sheet->setCellValue('F1', 'Nilai Akhir');

        $id_periode = $request->input('id_periode');
        $id_cabang = $request->input('id_cabang');
        $id_bidang = $request->input('id_bidang');
        $id_departement = $request->input('id_departement');

        // Jika id_periode belum dipilih, ambil periode terbaru
        if (!$id_periode) {
            $periode_terbaru = m_periode::orderBy('created_at', 'desc')->first();
            if (!$periode_terbaru) {
                return redirect()->back()->withErrors(['msg' => 'No periode available']);
            }
            $id_periode = $periode_terbaru->id;
        }

        // Filter
        $karyawansQuery = M_karyawan::join('m_bidang', 'm_karyawan.id_bidang', '=', 'm_bidang.id')
            ->join('m_cabang', 'm_karyawan.id_cabang', '=', 'm_cabang.id')
            ->select('m_karyawan.*', 'm_cabang.nama as nama_cabang', 'm_karyawan.no_pegawai', 'm_bidang.nama_bidang');

        if ($id_cabang && $id_cabang !== "all") {
            $karyawansQuery->where('m_karyawan.id_cabang', $id_cabang);
        }
        if ($id_bidang && $id_bidang !== "all") {
            $karyawansQuery->where('m_karyawan.id_bidang', $id_bidang);
        }
        if ($id_departement && $id_departement !== "all") {
            $karyawansQuery->whereHas('bidang', function ($query) use ($id_departement) {
                $query->where('id_departement', $id_departement);
            });
        }

        $karyawans = $karyawansQuery->get();

        $periode_terpilih = m_periode::find($id_periode);
        if (!$periode_terpilih) {
            return redirect()->back()->withErrors(['msg' => 'Periode not found']);
        }

        // Fetch nilai_karyawan
        $nilai_karyawan = [];
        foreach ($karyawans as $karyawan) {
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

            $departement = DB::table('m_bidang as mb')
                ->where('mb.id', $karyawan->id_bidang)
                ->join('m_departement as d', 'd.id', '=', 'mb.id_departement')
                ->select('d.nama_departement')
                ->first();

            // Ambil data status approval
            $nilai = DB::table('m_nilai')
                ->select('indeks', 'status_approval_2')
                ->where('id_karyawan', $karyawan->id)
                ->where('id_periode', $id_periode)
                ->first();

            if ($nilai) {
                $nilai_karyawan[$karyawan->id] = [
                    'nilai_approval_2' => $nilai_approval_2,
                    'status_approval_2' => $nilai->status_approval_2,
                    'departement' => $departement ? $departement->nama_departement : null
                ];
            } else {
                $nilai_karyawan[$karyawan->id] = [
                    'nilai_approval_2' => null,
                    'status_approval_2' => null,
                    'departement' => $departement ? $departement->nama_departement : null
                ];
            }
        }

        $row = 2;
        foreach ($karyawans as $karyawan) {
            $sheet->setCellValue('A' . $row, $karyawan->nama_cabang);
            $sheet->setCellValue('B' . $row, $nilai_karyawan[$karyawan->id]['departement']);
            $sheet->setCellValue('C' . $row, $karyawan->nama_bidang);
            $sheet->setCellValue('D' . $row, $karyawan->no_pegawai);
            $sheet->setCellValue('E' . $row, $karyawan->nama);
            $sheet->setCellValue('F' . $row, $nilai_karyawan[$karyawan->id]['nilai_approval_2']);
            $row++;
        }

        // Write to file
        $writer = new Xlsx($spreadsheet);
        $fileName = "rekapNilai.xlsx";
        $filePath = storage_path('app/public/' . $fileName);
        $writer->save($filePath);

        return response()->download($filePath)->deleteFileAfterSend(true);
    }
}

