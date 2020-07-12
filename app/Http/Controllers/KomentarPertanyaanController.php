<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\KomentarPertanyaan;

class KomentarPertanyaanController extends Controller
{    
    public function store(Request $request) {
        $pertanyaan_id = $request['pertanyaan_id'];
        $messages = [
            "required" => ":attribute tidak boleh kosong!",
            "min" => ":attribute harus diisi minimal :min karakter!"
        ];

        $this->validate($request, [
            "isi" => "required|min:5"
        ], $messages);
        
        KomentarPertanyaan::create([
            "user_id" => $request["user_id"],
            "pertanyaan_id" => $request["pertanyaan_id"],
            "isi" => $request["isi"]
        ]);

        return redirect()->back();
    }
}