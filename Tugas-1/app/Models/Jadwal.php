<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;
    protected $fillable = [
        'court_id',
        'tanggal',
        'jam_mulai',
        'jam_selesai',
        'harga',
        'status',
    ];

    public function court()
    {
        return $this->belongsTo(Court::class);
    }
}
