<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pertanyaan;
use App\Jawaban;

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
            "user_id" => "required",
            "judul" => "required|min:5",
            "isi" => "required|min:5",
            "tag" => "required"
        ], $messages);
        
        Pertanyaan::create([
            "user_id" => $request["user_id"],
            "judul" => $request["judul"],
            "isi" => $request["isi"],
            "tag" => $request["tag"]
        ]);

        return redirect('/pertanyaan');
    }
    
    public function show($id, Request $request)
    {
        $pertanyaan_id = $request['pertanyaan_id'];
        $tanya = Pertanyaan::find($id);
        $string = str_replace(' ', '', $tanya->tag);
        $tags = array_filter(explode(',',$string));
        $jawab = Jawaban::all();
        return view('pertanyaan.show', compact('tanya','tags', 'jawab'), ["pertanyaan_id"=>$pertanyaan_id]);
    }

    public function edit($id) {
        $tanya = Pertanyaan::find($id);
        return view('pertanyaan.edit', compact('tanya'));
    }

    public function update($id, Request $request) {
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
        $hapus = Pertanyaan::find($id);

        $hapus->delete();

        return redirect('/pertanyaan');
    }
}
