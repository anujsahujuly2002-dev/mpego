<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserEmergency extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'emergency_contact_name',
        'emergency_contact_phone',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
