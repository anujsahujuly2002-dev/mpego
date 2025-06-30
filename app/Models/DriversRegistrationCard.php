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
}
