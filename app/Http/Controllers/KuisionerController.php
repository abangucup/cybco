<?php

namespace App\Http\Controllers;

use App\Models\Kuisioner;
use Illuminate\Http\Request;

class KuisionerController extends Controller
{
    public function index()
    {
        $kuisioners = Kuisioner::all();
        return view('admin.kuisioner.index', compact('kuisioners'));
    }
}
