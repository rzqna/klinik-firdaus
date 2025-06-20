<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kriteria extends Model
{
    use HasFactory;

    protected $table = 'kriterias';

    protected $fillable = [
        'kriteria',
        'bobot_kriteria',
        'keterangan',
    ];

    //kalo relasi hasMany, nama function jamak (pake s), terus relasi mengarah ke model
    // Tambahkan relasi ini: Satu Kriteria bisa memiliki banyak SubKriteria
    public function subkriterias(): HasMany
    {
        return $this->hasMany(SubKriteria::class);
    }
}
