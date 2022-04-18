<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Berita;
use Illuminate\Support\Facades\Crypt;

class BeritaGooritaController extends Controller
{
    //tampil semua berita
    public function index()
    {
        $berita_public = Berita::latest('published_date')->paginate(3);
        return view('berita', compact('berita_public'));
    }

    //detail berita
    public function detail($id)
    {
        $enkripsi = decrypt($id);
        $berita = Berita::find($enkripsi);
        return view('berita_detail', compact('berita'));
    }
}
