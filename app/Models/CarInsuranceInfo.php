<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CarInsuranceInfo extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable =  [
        'user_id',
        'carrier',
        'policy_number',
        'agent_name'
    ];

    public function carInsuranceInfoImages()
    {
        return $this->hasMany(InsuranceImage::class, 'car_insurance_info_id', 'id');
    }

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    
}
