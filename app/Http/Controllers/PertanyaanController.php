<?php

namespace App\Http\Controllers;

use App\Models\Pertanyaan;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PertanyaanController extends Controller
{
    public function index()
    {
        $pertanyaans = Pertanyaan::paginate(5);
        return view('kelola.pertanyaan.index', compact('pertanyaans'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'pertanyaan' => 'required',
        ]);

        $pertanyaan = new Pertanyaan();
        $pertanyaan->pertanyaan = $request->pertanyaan;
        $pertanyaan->save();

        Alert::success('Tambah Pertanyaan', 'Pertanyaan berhasil ditambahkan');
        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'pertanyaan' => 'required'
        ]);

        $pertanyaan = Pertanyaan::findOrFail($id);
        $pertanyaan->update([
            'pertanyaan' => $request->pertanyaan,
        ]);

        Alert::success('Ubah Pertanyaan', 'Pertanyaan berhasil diubah');
        return redirect()->back();
    }

    public function destroy(Pertanyaan $pertanyaan)
    {
        $pertanyaan->delete();
        Alert::success('Hapus Data', 'Pertanyaan berhasil dihapus');
        return back();
    }
}
