<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherDriverId extends Model
{
    use HasFactory;
    protected $fillable = [
        'accident_id',
        'name',
        'license_no',
        'image'
    ];

    public function getImageAttribute($value) {
        return env('IMAGE_URL'). '/storage/upload/other-drivers-id/'.$this->accidentInfo->user_id.'/'.$this->accidentInfo->id .'/'. $value;
    }


    public function accidentInfo() {
        return $this->belongsTo(AccidentInfo::class,'accident_id','id');
    }
}
