<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use HasFactory;

    // Menentukan tabel yang digunakan oleh model ini
    protected $table = 'about';

    // Kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'title',
        'description',
    ];
}

