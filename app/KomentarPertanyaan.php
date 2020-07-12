<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KomentarPertanyaan extends Model
{
    protected $table = "komentar_pertanyaan";

    protected $fillable = ["user_id", "pertanyaan_id", "isi"];

    protected $guarded = [];
}
