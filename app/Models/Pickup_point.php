<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pickup_point extends Model
{
    use HasFactory;
    protected $fillable = [
        'pickup_point_name', 'pickup_point_address', '', 'pickup_point_phone', 'pickup_point_phone_two'
    ];
}
