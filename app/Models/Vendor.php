<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vendor extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'name_of_business',
        'name_of_contact',
        'email',
        'phone_number',
        'address',
    ];
}
