<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_number', 'kapasitas', 'harga', 'status', 'detail', 'kategori_id','image'
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
