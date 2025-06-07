<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HealthInsuranceImage extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'health_insurance_id',
        'image'
    ];

    public function getImageAttribute($value)
    {
        return env('IMAGE_URL'). '/storage/upload/health-insurance-image/'.$this->attributes['health_insurance_id'] .'/'. $value;
    }
}
