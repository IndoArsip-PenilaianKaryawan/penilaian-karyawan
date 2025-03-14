<?php

    namespace App\Http\Controllers;

use App\Models\M_nilai;
use Illuminate\Http\Request;
    use App\Models\M_periode;

    class PeriodeController extends Controller
    {
        public function index(Request $request)
        {
            $search = $request->input('search');

            $periodesQuery = M_periode::query();

            if ($search) {
                $periodesQuery->where('nama_periode', 'like', '%' . $search . '%')
                    ->orWhere('tahun', 'like', '%' . $search . '%');
            }

            $periodes = $periodesQuery->paginate(10);
            return view('periode.index', compact('periodes'));
        }

        public function create()
        {
            return view('periode.create');
        }

        public function store(Request $request)
        {
            $request->validate([
                'nama_periode' => 'required|string',
                'tahun' => 'required|string'
            ]);

            M_periode::create([
                'nama_periode' => $request->nama_periode,
                'tahun' => $request->tahun
            ]);

            return redirect()->route('periode.index')
                ->with('success', 'Periode berhasil ditambahkan');
        }

        public function edit($id)
        {
            $periode = M_periode::findOrFail($id);
            return view('periode.edit', compact('periode'));
        }

        public function update(Request $request, $id)
        {
            $request->validate([
                'nama_periode' => 'required|string',
                'tahun' => 'required|string'
            ]);

            $periode = M_periode::findOrFail($id);
            $periode->nama_periode = $request->nama_periode;
            $periode->tahun = $request->tahun;
            $periode->save();

            return redirect()->route('periode.index')
                ->with('success', 'Periode berhasil diperbarui');
        }

        public function destroy($id)
        {
            M_nilai::where('id_periode', $id)->update(['id_periode' => null]);
            $periode = M_periode::findOrFail($id);
            $periode->delete();

            return redirect()->route('periode.index')
                ->with('success', 'Periode berhasil dihapus');
        }
    }
