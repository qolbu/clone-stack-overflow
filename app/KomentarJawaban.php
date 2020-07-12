<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KomentarJawaban extends Model
{
    protected $table = "komentar_jawaban";

    protected $fillable = ["user_id", "jawaban_id", "isi"];

    protected $guarded = [];
}
