<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pertanyaan extends Model
{
    protected $table="pertanyaan";

    protected $fillable = ["judul", "isi", "tag"];

    protected $guarded = [];
}
