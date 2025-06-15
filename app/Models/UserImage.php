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
        'image',
        'insurance_image',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function getImageAttribute($value)
    {
        return !is_null($value) ? env('IMAGE_URL'). '/storage/upload/user-image/'.$this->attributes['user_id'] .'/'.$value:NULL;
    }

    public function getInsuranceImageAttribute($value)
    {
        return !is_null($value) ?  env('IMAGE_URL'). '/storage/upload/insurance-image/'.$this->attributes['user_id'] .'/'.$value:NULL;
    }
}
