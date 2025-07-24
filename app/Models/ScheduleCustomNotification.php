<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduleCustomNotification extends Model
{
    use HasFactory;
    protected $fillable = [
        'message',
        'schedule_time',
        'status',
    ];
}
