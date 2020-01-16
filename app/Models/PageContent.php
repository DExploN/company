<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageContent extends Model
{
    protected $fillable = [
        'title',
        'description',
        'text',
        'language',
        'keywords',
        'h1',
        'page_id'
    ];
}
