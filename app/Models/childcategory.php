<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class childcategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'childcategory_name','childcategory_slug'
    ];
}
