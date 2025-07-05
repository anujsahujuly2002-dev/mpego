<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DriversRegistrationCard extends Model
{
    use HasFactory;
    protected $fillable = [
        'accident_id','name','registration_no','image'
    ];

    public function getImageAttribute($value) {
        return env('IMAGE_URL') . '/storage/upload/driver-registration-card-image/'.$this->accident->user_id .'/'. $this->accident->id . '/' . $value;
    }

    public function accident() {
        return $this->belongsTo(AccidentInfo::class, 'accident_id', 'id');
    }
}

