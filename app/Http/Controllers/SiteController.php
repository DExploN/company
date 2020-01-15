<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index()
    {
        $title = trans('main title');
        $description = trans('main description');
        $keywords = trans('main keywords');
        return view('site.index', compact('description', 'keywords', 'title'));
    }

    public function portfolio()
    {
        $title = trans('portfolio title');
        $description = trans('portfolio description');
        $keywords = trans('portfolio keywords');

        $h1 = trans('portfolio h1');
        $portfolios = Portfolio::with(['contents', 'media'])->get();
        return view('site.portfolio', compact('title', 'description', 'keywords', 'h1', 'portfolios'));
    }
}
