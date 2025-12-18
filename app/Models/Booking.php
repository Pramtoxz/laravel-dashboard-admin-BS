<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'kode_booking',
        'user_id',
        'mobil_id',
        'tanggal_mulai',
        'tanggal_selesai',
        'durasi_hari',
        'harga_per_hari',
        'total_harga',
        'bukti_bayar',
        'status_pembayaran',
        'status_booking',
        'catatan_customer',
        'catatan_admin',
        'verified_at',
        'checked_in_at',
        'completed_at',
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
        'verified_at' => 'datetime',
        'checked_in_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function mobil()
    {
        return $this->belongsTo(Mobil::class);
    }

    public static function generateKodeBooking()
    {
        $prefix = 'BK';
        $date = date('Ymd');
        $lastBooking = self::whereDate('created_at', today())->latest()->first();
        $number = $lastBooking ? intval(substr($lastBooking->kode_booking, -4)) + 1 : 1;
        return $prefix . $date . str_pad($number, 4, '0', STR_PAD_LEFT);
    }
}
