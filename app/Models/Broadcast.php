<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Broadcast extends Model
{
    protected $fillable = [
        'judul',
        'pesan',
        'tipe',
        'target',
        'total_terkirim',
        'dikirim_pada',
        'dikirim_oleh',
    ];

    protected $casts = [
        'dikirim_pada' => 'datetime',
    ];

    public function pengirim()
    {
        return $this->belongsTo(User::class, 'dikirim_oleh');
    }
}
