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
}
