<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DriverInsurance extends Model
{
    use HasFactory;

    protected $fillable = [
        'accident_id',
        'member_name',
        "member_id",
        "image"
    ];
}
