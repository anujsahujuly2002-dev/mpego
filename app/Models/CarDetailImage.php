<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CarDetailImage extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'car_detail_id','images'
    ];

    public function getImagesAttribute($value)
    {
        return env('IMAGE_URL'). '/storage/upload/car-details/'.$this->attributes['car_detail_id'] .'/'. $value;
    }

}
