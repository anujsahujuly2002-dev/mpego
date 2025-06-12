<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AccountDeleteRequest extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'reason_id',
        'comments',
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function accountDeleteReason() {
        return $this->belongsTo(AccountDeleteReason::class,'reason_id','id');
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('M dS Y');
    }
    
}
