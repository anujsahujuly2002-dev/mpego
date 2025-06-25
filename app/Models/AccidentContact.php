<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccidentContact extends Model
{
    use HasFactory;
    protected $fillable = [
        "user_id","accident_id","name","contact_no",
    ];

    protected $hidden = [
        "created_at","updated_at","user_id","id"
    ];
}
