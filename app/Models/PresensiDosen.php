<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PresensiDosen extends Model
{
    protected $guarded = [];

    public function dosen()
    {
        return $this->belongsTo(Dosen::class);
    }
}
