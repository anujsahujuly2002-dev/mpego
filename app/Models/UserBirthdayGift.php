<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBirthdayGift extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'gift_card_id',
        'token',
        'scratched_at',
        'token'
    ];

    public function giftCard() {
        return $this->belongsTo(GiftCard::class,'gift_card_id','id');
    }
}
