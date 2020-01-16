<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Page\StoreRequest;
use App\Http\Requests\Page\UpdateLangRequest;
use App\Http\Requests\Page\UpdateRequest;
use App\Models\Page;
use App\Models\PageContent;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $pages = Page::with('contents')->paginate(3);
        $locale = config('app.default_locale');
        return view('admin.page.index', compact('pages', 'locale'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $page = new Page();
        $locale = config('app.default_locale');
        return view('admin.page.create', compact('locale', 'page'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return RedirectResponse
     */
    public function store(StoreRequest $request)
    {


        $page = new Page($request->only(['path']));
        $page->save();

        $PageContent = new PageContent($request->only(['title', 'description', 'text', 'h1', 'keywords']));
        $PageContent->language = config('app.default_locale');
        $page->contents()->save($PageContent);

        return redirect()->route('admin.page.edit', ['page' => $page->id])->with(['success-message' => trans('page added')]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param page $page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Page $page)
    {
        $page->load(['allContents']);
        $locale = config('app.default_locale');
        $languages = array_keys(LaravelLocalization::getSupportedLocales());
        return view('admin.page.edit', compact('locale', 'page', 'languages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param page $page
     * @return RedirectResponse
     */
    public function update(UpdateRequest $request, Page $page)
    {

        $page->fill($request->only(['path']));
        $page->save();

        PageContent::updateOrCreate(
            ['language' => config('app.default_locale'), 'page_path' => $page->path],
            $request->only(['title', 'description', 'text', 'h1', 'keywords'])
        );

        return redirect()->route('admin.page.edit', ['page' => $page->path])->with(['success-message' => trans('page updated')]);

    }

    public function updateLang(UpdateLangRequest $request, Page $page)
    {
        PageContent::updateOrCreate(
            ['language' => $request->input('language'), 'page_path' => $page->path],
            $request->only(['title', 'description', 'text', 'h1', 'keywords'])
        );
        return redirect()->back()->with(['success-message' => trans('page language content updated')]);
    }

    public function destroyLang(Request $request, page $page)
    {
        PageContent::where(
            [
                ['language', '=', $request->input('language')],
                ['page_id', '=', $page->id]
            ]
        )->delete();
        return redirect()->back()->with(['success-message' => trans('page language content deleted')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param page $page
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(Page $page)
    {
        $page->delete();
        return redirect()->route('admin.page.index')->with('success-message', trans('page deleted'));
    }
}
