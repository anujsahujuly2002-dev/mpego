<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccidentInfo extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'user_type',
        'accident_date',
        'accident_time',
        'who_was_with_you',
        'description',
    ];
}
