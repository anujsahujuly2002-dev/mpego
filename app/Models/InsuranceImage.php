<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InsuranceImage extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'car_insurance_info_id','image'
    ];

    public function getImageAttribute($value)
    {
        return env('IMAGE_URL'). '/storage/upload/car-insurance/'. $this->carInsuranceInfo->user_id .'/'. $value;
    }

    public function carInsuranceInfo()
    {
        return $this->belongsTo(CarInsuranceInfo::class, 'car_insurance_info_id');
    }
}
