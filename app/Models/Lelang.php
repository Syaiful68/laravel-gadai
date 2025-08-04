<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lelang extends Model
{
    //
    protected $table = 'tb_lelang';
    protected $guarded = ['id'];

    public function pinjam()
    {
        return $this->belongsTo(Pinjaman::class);
    }
}
