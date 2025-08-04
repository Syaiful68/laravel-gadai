<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nasabah extends Model
{
    //
    protected $table = 'tb_nasabah';
    protected $guarded = ['id'];

    public function pinjaman()
    {
        return $this->hasMany(Pinjaman::class);
    }
}
