<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\KomentarJawaban;

class KomentarJawabanController extends Controller
{    
    public function store(Request $request) {
        $jawaban_id = $request['jawaban_id'];
        $messages = [
            "required" => ":attribute tidak boleh kosong!",
            "min" => ":attribute harus diisi minimal :min karakter!"
        ];

        $this->validate($request, [
            "isi" => "required|min:5"
        ], $messages);
        
        KomentarJawaban::create([
            "user_id" => $request["user_id"],
            "jawaban_id" => $request["jawaban_id"],
            "isi" => $request["isi"]
        ]);

        return redirect()->back();
    }
}