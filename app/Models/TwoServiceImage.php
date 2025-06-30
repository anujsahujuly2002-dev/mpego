<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TwoServiceImage extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'two_services_id',
        'image',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function getImageAttribute($value)
    {
        return env('IMAGE_URL') . '/storage/upload/two-service-image/' . $this->twoService->user_id . '/' . $value;
    }

    public function twoService() {
        return $this->belongsTo(TwoService::class, 'two_services_id','id');
    }
}
