<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PortfolioImage extends Model
{
    protected $fillable = ['name', 'portfolio_id'];

    public function portfolio()
    {
        return $this->belongsTo(Portfolio::class);
    }

    public function getUrlAttribute()
    {
        return asset('storage/' . config('settings.portfolio.images.path')) . '/' . $this->name;
    }
}
