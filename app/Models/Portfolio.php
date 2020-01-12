<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Portfolio extends Model
{
    protected $fillable = [
        'image',
        'android_link',
        'apple_link'
    ];

    public function contents()
    {
        return $this->hasMany(PortfolioContent::class)
            ->where('language', config('app.default_locale'))
            ->orWhere('language', App::getLocale());
    }

    public function trans($attribute)
    {
        $content = $this->contents->firstWhere('language', App::getLocale()) ?? $this->contents->first();
        return $content->{$attribute};
    }
}
