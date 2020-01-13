<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\App;

class Portfolio extends Model
{
    protected $fillable = [
        'image',
        'android_link',
        'apple_link',
        'year'
    ];

    public function getImageUrlAttribute()
    {
        return asset('storage/' . config('settings.portfolio.logo.path')) . '/' . $this->image;
    }

    public function allContents(): HasMany
    {
        return $this->hasMany(PortfolioContent::class);
    }

    public function contents()
    {
        return $this->hasMany(PortfolioContent::class)
            ->where('language', config('app.default_locale'))
            ->orWhere('language', App::getLocale());
    }

    public function images()
    {
        return $this->hasMany(PortfolioImage::class);
    }

    public function trans($attribute, $locale = null)
    {
        if ($locale) {
            $content = $this->allContents->firstWhere('language', $locale);
        } else {
            $content = $this->contents->firstWhere('language', App::getLocale()) ?? $this->contents->first();
        }
        if (!$content) {
            return null;
        }
        return $content->{$attribute};
    }
}
