<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class Page extends Model
{
    protected $fillable = ['path'];

    protected $primaryKey = 'path';

    public $incrementing = false;

    public function getRouteKeyName()
    {
        return 'path';
    }

    public function allContents(): HasMany
    {
        return $this->hasMany(PageContent::class, 'page_path', 'path');
    }

    public function contents()
    {
        return $this->hasMany(PageContent::class, 'page_path', 'path')
            ->whereIn('language', [App::getLocale(), config('app.default_locale')]);
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
