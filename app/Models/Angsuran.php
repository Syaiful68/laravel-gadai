<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Angsuran extends Model
{
    //
    protected $table = 'tb_angsurans';
    protected $guarded = ['id'];

    public function pinjaman()
    {
        return $this->belongsTo(Pinjaman::class);
    }
}
