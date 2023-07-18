<?php

namespace App\Http\Controllers;

use App\Models\Pertanyaan;
use Illuminate\Http\Request;

class PertanyaanController extends Controller
{
    public function index()
    {
        $pertanyaans = Pertanyaan::all();
        return view('admin.pertanyaan.index', compact('pertanyaans'));
    }
}
