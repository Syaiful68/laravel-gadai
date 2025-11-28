<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lelang extends Model
{
    //
    protected $table = 'tb_lelang';
    protected $guarded = ['id'];

    public function pinjam()
    {
        return $this->belongsTo(Pinjaman::class);
    }
    public function nasabah()
    {
        return $this->belongsTo(Nasabah::class);
    }
}
