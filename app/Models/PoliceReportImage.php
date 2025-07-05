<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PoliceReportImage extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id","accident_id","image"
    ];


    public function getImageAttribute($value) {

        return  env('IMAGE_URL'). '/storage/upload/police-report-image/'.$this->attributes['user_id'].'/'.$this->attributes['accident_id'].'/'.$value;
    }
}
