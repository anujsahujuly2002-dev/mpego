<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HealthInsurance extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'user_id',
        'medi_care',
        'policy_number',
        'insurer_name',
        'insurance_carrier'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function setMediCareAttribute($value)
    {
        $this->attributes['medi_care'] = strtolower($value) === 'yes' ? '1' : '0';
    }

    public function healthInsuranceImages()
    {
        return $this->hasMany(HealthInsuranceImage::class, 'health_insurance_id', 'id');
    }

}
