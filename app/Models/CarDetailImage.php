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

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    public function getImagesAttribute($value)
    {
        return env('IMAGE_URL'). '/storage/upload/car-details/'.$this->carDetail->user_id .'/'. $value;
    }

    public function carDetail() {
        return $this->belongsTo(CarDetail::class,'car_detail_id','id');
    }

}
