<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TwoService extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'user_id',
        'membership_number',
        'tow_contact_info',
        'emergency_contact_1',
        'emergency_contact_2',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function twoServiceImages()
    {
        return $this->hasMany(TwoServiceImage::class, 'two_services_id', 'id');
    }
}
