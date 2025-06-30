<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherDriverId extends Model
{
    use HasFactory;
    protected $fillable = [
        'accident_id',
        'name',
        'license_no',
        'image'
    ];
}
