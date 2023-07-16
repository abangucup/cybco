<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index()
    {
        $siswa = Siswa::paginate(10);
        return view('admin.siswa.index', compact('siswa'));
    }
}
