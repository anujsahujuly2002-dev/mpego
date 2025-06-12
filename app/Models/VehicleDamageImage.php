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

    public function getImagesAttribute($value) {
        return env('IMAGE_URL'). '/storage/upload/vehicle-damage-image/'.$this->attributes['user_id'].'/'.$this->attributes['accident_id'] .'/'. $value;
    }
}
