<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\App;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Portfolio extends Model implements HasMedia
{
    use HasMediaTrait;

    public function registerMediaConversions(Media $media = null)
    {
        if ($media->collection_name === 'logo') {
            $this->addMediaConversion('needed')
                ->width(config('settings.portfolio.logo.width'))
                ->height(config('settings.portfolio.logo.height'));
        }

    }

    protected $fillable = [
        'android_link',
        'apple_link',
        'year'
    ];


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
