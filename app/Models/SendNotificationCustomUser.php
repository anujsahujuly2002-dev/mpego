<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SendNotificationCustomUser extends Model
{
    use HasFactory;
    protected $fillable = [
        'schedule_custom_notify_id',
        'user_id'
    ];
}
