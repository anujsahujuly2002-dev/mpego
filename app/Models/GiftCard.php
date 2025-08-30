<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiftCard extends Model
{
    use HasFactory;
    protected $fillable = [
        'gift-card',
        'gift-card-image',
        'gift-card-expire_at'
    ];

    public function userBirthDayGift() {
        return $this->hasOne(UserBirthdayGift::class,'gift_card_id','id');
    }

    public function getAttribute($key)
    {
        if ($key === 'gift_card_image') {
            // dd($key);
            $value = $this->getOriginal('gift-card-image');
            return !is_null($value) ? env('IMAGE_URL') . '/storage/upload/gift-card/' . $value : null;
        }
        return parent::getAttribute($key);
    }
}
