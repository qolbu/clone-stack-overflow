<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jawaban;

class JawabanController extends Controller
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
        
        Jawaban::create([
            "user_id" => $request["user_id"],
            "pertanyaan_id" => $request["pertanyaan_id"],
            "isi" => $request["isi"]
        ]);

            return redirect()->back();
    }
}