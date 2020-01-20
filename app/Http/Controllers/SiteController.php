<?php

namespace App\Http\Controllers;

use App\Models\Page;
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
        $h1FaImage = 'fas fa-briefcase';
        $h1 = trans('portfolio h1');
        $portfolios = Portfolio::with(['media'])->get();
        return view('site.portfolio', compact('title', 'description', 'keywords', 'h1', 'portfolios', 'h1FaImage'));
    }

    public function page(Page $page)
    {
        $title = $page->trans('title');
        $description = $page->trans('description');
        $keywords = $page->trans('keywords');
        $h1 = $page->trans('h1');
        $h1FaImage = $page->fa_code;
        return view('site.page', compact('title', 'description', 'keywords', 'h1', 'page', 'h1FaImage'));
    }
}
