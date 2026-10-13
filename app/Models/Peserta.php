<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peserta extends Model
{
    protected $table = 'peserta';
    protected $fillable = ['nama', 'email', 'no_hp', 'skema_id'];

    public function skema()
    {
        return $this->belongsTo(Skema::class, 'skema_id');
    }
}
