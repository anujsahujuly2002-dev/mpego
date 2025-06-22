<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class medicalImage extends Model
{
    use HasFactory;
    protected $fillable = [
        "medical_id","image"
    ];

    public function getImageAttribute($value) {
        // dd();
        return env('IMAGE_URL'). '/storage/upload/medical-image/'.$this->medical->user_id.'/'.$this->medical->id .'/'. $value;
    }

    public function medical() {
        return $this->belongsTo(medical::class,"medical_id","id");
    }
}
