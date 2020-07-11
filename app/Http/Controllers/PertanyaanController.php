<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pertanyaan;

class PertanyaanController extends Controller
{
    public function index() {
        $pertanyaan = Pertanyaan::all();
        
        return view('pertanyaan.index', compact('pertanyaan'));
    }

    public function create() {
        return view('pertanyaan.form');
    }

    public function store(Request $request) {
        $messages = [
            "required" => ":attribute tidak boleh kosong!",
            "min" => ":attribute harus diisi minimal :min karakter!"
        ];

        $this->validate($request, [
            "judul" => "required|min:5",
            "isi" => "required|min:5",
            "tag" => "required"
        ], $messages);
        
        Pertanyaan::create([
            "judul" => $request["judul"],
            "isi" => $request["isi"],
            "tag" => $request["tag"]
        ]);

        return redirect('/pertanyaan');
    }
    
    public function show($id)
    {
        //$tanya = PertanyaanModel::find_by_id($id);
        $tanya = Pertanyaan::find($id);
        $string = str_replace(' ', '', $tanya->tag);
        $tags = array_filter(explode(',',$string));
        return view('pertanyaan.show', compact('tanya','tags'));
    }

    public function edit($id) {
        //$tanya = PertanyaanModel::find_by_id($id);
        $tanya = Pertanyaan::find($id);
        return view('pertanyaan.edit', compact('tanya'));
    }

    public function update($id, Request $request) {
        //$tanya = PertanyaanModel::update($id, $request->all());
        $messages = [
            "required" => ":attribute tidak boleh kosong!",
            "min" => ":attribute harus diisi minimal :min karakter!"
        ];

        $this->validate($request, [
            "judul" => "required|min:5",
            "isi" => "required|min:5",
            "tag" => "required"
        ], $messages);

        $tanya = Pertanyaan::find($id);
        $tanya->judul = $request->judul;
        $tanya->isi = $request->isi;
        $tanya->tag = $request->tag;
        $tanya->save();
        
        return redirect('/pertanyaan');
    }

    public function destroy($id) {
        //$hapus = PertanyaanModel::destroy($id);
        $hapus = Pertanyaan::find($id);

        $hapus->delete();

        return redirect('/pertanyaan');
    }
}
