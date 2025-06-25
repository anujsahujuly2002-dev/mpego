<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrivateCard extends Model
{
    use HasFactory;

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

    public function privateCardImage() {
        return $this->hasMany(PrivateCardImage::class,"private_card_id","id");
    }

}
