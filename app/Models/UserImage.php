<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserImage extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'user_id',
        'image'
    ];

    public function getImageAttribute($value)
    {
        return  env('IMAGE_URL'). '/storage/upload/user-image/'.$this->attributes['user_id'] .'/'.$value;
    }
}
