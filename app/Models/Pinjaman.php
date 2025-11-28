<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pinjaman extends Model
{
    //
    use SoftDeletes;
    protected $table = 'tb_pinjaman';
    protected $guarded = ['id'];

    public function nasabah()
    {
        return $this->belongsTo(Nasabah::class);
    }
    public function angsuran()
    {
        return $this->hasMany(Angsuran::class);
    }

    public function lelang()
    {
        return $this->hasMany(Lelang::class);
    }
}
