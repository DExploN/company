<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    protected $fillable = [
        'title', 'image', 'description', 'text', 'android_link', 'apple_link'
    ];
}
