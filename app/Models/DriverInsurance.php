<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DriverInsurance extends Model
{
    use HasFactory;

    protected $fillable = [
        'accident_id',
        'member_name',
        "member_id",
        "image"
    ];

    public function getImageAttribute($value) {
        return env('IMAGE_URL'). '/storage/upload/driver-insurance-image/'.$this->accidentInfo->user_id.'/'.$this->accidentInfo->id .'/'. $value;
    }

    public function accidentInfo() {
        return $this->belongsTo(AccidentInfo::class,'accident_id','id');
    }
}
