<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    use HasFactory;

    protected $table = 'jabatans';

    protected $fillable = [
        'jabatan'
    ];

    public function users()
    {
        //kalo relasi hasMany, nama function jamak (pake s), terus relasi mengarah ke model
        //disini jabatan to model user
        return $this->hasMany(User::class); //relasi many to one (jabatan punya banyak user)
    }
}
