<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrivateCardImage extends Model
{
    use HasFactory;
    protected $fillable = [
        "private_card_id","image"
    ];

    public function getImageAttribute($value) {
        return env('IMAGE_URL'). '/storage/upload/private-card/'.$this->privateCard->user_id.'/'.$this->privateCard->id .'/'. $value;
    }

    public function privateCard() {

        return $this->belongsTo(PrivateCard::class,"private_card_id","id");
    }
}
