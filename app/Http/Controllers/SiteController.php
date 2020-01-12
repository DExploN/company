<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index()
    {
        $title = 'Заголовок главной';
        $description = 'Описание главной';
        $keywords = 'Ключевые слова главной';
        return view('site.index', compact('description', 'keywords', 'title'));
    }

    public function portfolio()
    {
        $title = 'Заголовок портфолио';
        $description = 'Описание портфолио';
        $keywords = 'Ключевые слова портфолио';

        $h1 = 'H1 Портволио';
        $portfolios = Portfolio::with('contents')->get();
        return view('site.portfolio', compact('title', 'description', 'keywords', 'h1', 'portfolios'));
    }
}
