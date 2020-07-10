<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PertanyaanModel;
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
        $new_pertanyaan = new Pertanyaan;
        $new_pertanyaan->judul = $request["judul"];
        $new_pertanyaan->isi = $request["isi"];
        $new_pertanyaan->tag = $request["tag"];

        $new_pertanyaan->save();

        return redirect('/pertanyaan');
    }
    
    public function show($id)
    {
        $tanya = PertanyaanModel::find_by_id($id);

        return view('pertanyaan.show', compact('tanya'));
    }

    public function edit($id) {
        $tanya = PertanyaanModel::find_by_id($id);
        return view('pertanyaan.edit', compact('tanya'));
    }

    public function update($id, Request $request) {
        $tanya = PertanyaanModel::update($id, $request->all());
        return redirect('/pertanyaan');
    }

    public function destroy($id) {
        $hapus = PertanyaanModel::destroy($id);
        return redirect('/pertanyaan');
    }
}
