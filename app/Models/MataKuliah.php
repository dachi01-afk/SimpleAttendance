<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    protected $guarded = [];

    public function jadwalKuliah()
    {
        return $this->hasMany(JadwalKuliah::class);
    }
}
