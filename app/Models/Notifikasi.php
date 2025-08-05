<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    //
    protected $table = 'notification';
    protected $guarded = ['id'];


    public function pinjaman()
    {
        return $this->belongsTo(Pinjaman::class);
    }
}
