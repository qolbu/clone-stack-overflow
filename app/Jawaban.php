<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jawaban extends Model
{
    protected $table = "jawaban";

    protected $fillable = ["isi", "pertanyaan_id"];

    protected $guarded = [];
}
