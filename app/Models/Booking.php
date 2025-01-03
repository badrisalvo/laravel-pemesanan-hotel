<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'kamar_id',
        'check_in',
        'check_out',
        'harga',
        'bukti_bayar',
        'status'
    ];

    // Relasi dengan User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi dengan Kamar
    public function kamar()
    {
        return $this->belongsTo(Kamar::class);
    }
}
