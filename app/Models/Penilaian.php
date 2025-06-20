<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Penilaian extends Model
{
    use HasFactory;

    protected $table = 'penilaian_karyawan'; // Nama tabelnya
    protected $fillable = ['user_id', 'subkriteria_id', 'nilai_karyawan'];

     // Relasi ke User
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke SubKriteria
    public function subkriteria(): BelongsTo
    {
        return $this->belongsTo(SubKriteria::class);
    }
}
