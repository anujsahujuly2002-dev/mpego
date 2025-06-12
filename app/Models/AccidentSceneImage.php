<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AccidentSceneImage extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'user_id',
        'accident_id',
        'images',
    ];

    public function getImagesAttribute($value) {
        return env('IMAGE_URL'). '/storage/upload/accident-scene-image/'.$this->attributes['user_id'].'/'.$this->attributes['accident_id'] .'/'. $value;
    }
}
