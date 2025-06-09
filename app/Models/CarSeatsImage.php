<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarSeatsImage extends Model
{
    use HasFactory;
    protected $fillable = [
        'accident_id',
        'user_id',
        'images'
    ];
}
