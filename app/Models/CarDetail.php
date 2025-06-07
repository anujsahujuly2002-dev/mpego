<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CarDetail extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'user_id','make','model','color','vin'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function setVehicleMakeAttribute($value)
    {
        $this->attributes['make'] = $value;
    }

    public function carImages()
    {
        return $this->hasMany(CarDetailImage::class, 'car_detail_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function getCarImagesOnlyAttribute()
    {
        return $this->carImages->pluck('images');
    }

}
