<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index()
    {
        $description = 'Описание главной';
        $keywords = 'Ключевые слова главной';

        $h1 = 'H1 главной';
        return view('site.index', compact('description', 'keywords', 'h1'));
    }

    public function portfolio()
    {
        $title = 'Заголовок портфолио';
        $description = 'Описание портфолио';
        $keywords = 'Ключевые слова портфолио';

        $h1 = 'H1 Портволио';
        return view('site.portfolio', compact('title', 'description', 'keywords', 'h1'));
    }
}
