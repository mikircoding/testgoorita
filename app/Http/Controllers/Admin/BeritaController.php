<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Berita;
use Carbon\Carbon;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;

class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $beritas = Berita::latest()->get();
        return view('dashboard', compact('beritas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('berita_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'title' => 'required',
            'short_description' => 'required',
            'description' => 'required',
            'published_date' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        //upload image
        $image = $request->file('image');
        $image->storeAs('public/image', $image->hashName());

        Berita::create([
            'title' => $request->input('title'),
            'short_description' => $request->input('short_description'),
            'description' => $request->input('description'),
            'published_date' => $request->input('published_date'),
            'image'         => $image->hashName(),
        ]);

        return redirect()->route('dashboard.index')->with('message', 'Tersimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $enkripsi = decrypt($id);
        $berita = Berita::find($enkripsi);
        return view('berita_detail', compact('berita'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $enkripsi = decrypt($id);
        $berita = Berita::find($enkripsi);
        return view('berita_edit', compact('berita'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'title' => 'required',
            'short_description' => 'required',
            'description' => 'required',
            'published_date' => 'required',
        ]);

        //jika dengan gambar
        if ($request->file('image')) {
            // update tanpa gambar
            $enkripsi = decrypt($id);
            $berita = Berita::findOrFail($enkripsi);

            //remove gambar lama
            Storage::disk('local')->delete('public/image/' . basename($berita->image));

            //upload gambar baru
            $image = $request->file('image');
            $image->storeAs('public/image', $image->hashName());


            $berita->update([
                'title' => $request->title,
                'short_description' => $request->short_description,
                'description' => $request->description,
                'published_date' => $request->published_date,
                'image' => $image->hashName(),
            ]);
        }

        $enkripsi = decrypt($id);
        $berita = Berita::findOrFail($enkripsi);
        //update data tanpa image
        $berita->update([
            'title' => $request->title,
            'short_description' => $request->short_description,
            'description' => $request->description,
            'published_date' => $request->published_date,
        ]);

        return redirect()->route('dashboard.index')
            ->with('message', 'Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $enkripsi = decrypt($id);
        $berita = Berita::findOrFail($enkripsi);

        //hapus file gambar
        Storage::disk('local')->delete('public/image/' . basename($berita->image));

        if ($berita->delete()) {
            return redirect()->back()->with('message', 'Terhapus');
        }
    }
}
