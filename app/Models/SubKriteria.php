<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SubKriteria extends Model
{
    use HasFactory;

    protected $table = 'subkriterias';

    protected $fillable = [
        'subkriteria',
        'kriteria_id',
        'nilai_ideal',
        'keterangan',
        'is_core_factor',
    ];

    protected $casts = [
        'is_core_factor' => 'boolean'
    ];

    // relasi: satu subkriteria dimiliki oleh satu kriteria
    public function kriteria(): BelongsTo{
        return $this->belongsTo(Kriteria::class);
    }
}
