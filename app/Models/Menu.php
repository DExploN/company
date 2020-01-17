<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = ['path', 'active_path', 'title', 'fa_code', 'sort'];
}
