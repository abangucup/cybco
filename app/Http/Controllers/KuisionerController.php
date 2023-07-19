<?php

namespace App\Http\Controllers;

use App\Models\Kuisioner;
use App\Models\Siswa;
use Illuminate\Http\Request;

class KuisionerController extends Controller
{
    public function index()
    {
        $jumlahKuis = Kuisioner::count();
        $siswas = Siswa::has('kuisioner')->with('kuisioner')->paginate(5);
        return view('kelola.kuisioner.index', compact('siswas', 'jumlahKuis'));
    }
}
