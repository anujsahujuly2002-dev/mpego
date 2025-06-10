<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VehicleDamageImage extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'accident_id',
        'user_id',
        'images'
    ];
}
