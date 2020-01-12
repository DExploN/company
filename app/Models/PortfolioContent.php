<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PortfolioContent extends Model
{
    protected $fillable = [
        'title',
        'description',
        'text',
        'language',
        'portfolio_id'
    ];
}
