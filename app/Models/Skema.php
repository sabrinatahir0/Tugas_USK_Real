<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skema extends Model
{
    protected $table = 'skema';

    protected $fillable = ['kode_skema', 'nama_skema'];

    public function peserta()
    {
        return $this->hasMany(Peserta::class, 'id_skema');
    }
}
