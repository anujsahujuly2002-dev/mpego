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

    public function getImagesAttribute()
    {
        return env('IMAGE_URL') . '/storage/upload/car-seats-image/' . $this->attributes['user_id'] . '/' . $this->attributes['accident_id'] . '/' . $this->attributes['images'];
    }
}
