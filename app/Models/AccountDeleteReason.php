<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountDeleteReason extends Model
{
    use HasFactory;

    protected $fillable = ['reason'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
}
