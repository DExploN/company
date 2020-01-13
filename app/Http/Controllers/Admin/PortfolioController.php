<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Portfolio\StoreRequest;
use App\Http\Requests\Portfolio\UpdateLangRequest;
use App\Http\Requests\Portfolio\UpdateRequest;
use App\Models\Portfolio;
use App\Models\PortfolioContent;
use App\Models\PortfolioImage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $portfolios = Portfolio::with('contents')->paginate(3);
        $locale = config('app.default_locale');
        return view('admin.portfolio.index', compact('portfolios', 'locale'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $portfolio = new Portfolio();
        $locale = config('app.default_locale');
        return view('admin.portfolio.create', compact('locale', 'portfolio'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return RedirectResponse
     */
    public function store(StoreRequest $request)
    {
        $portfolioContent = new PortfolioContent($request->only(['title', 'description', 'text']));
        $portfolioContent->language = config('app.default_locale');

        $portfolio = new Portfolio($request->only(['android_link', 'apple_link', 'year']));
        $file = $request->file('image');
        $file->store(config('settings.portfolio.logo.path'), 'public');
        $portfolio->image = $file->hashName();
        $portfolio->save();
        $portfolio->contents()->save($portfolioContent);

        $images = [];
        if (is_array($request->file('images'))) {
            foreach ($request->file('images') as $uploadImage) {
                $uploadImage->store(config('settings.portfolio.images.path'), 'public');
                $images[] = new PortfolioImage(['name' => $uploadImage->hashName()]);
            }
            $portfolio->images()->saveMany($images);
        }


        return redirect()->route('admin.portfolio.edit', ['portfolio' => $portfolio->id])->with(['success-message' => trans('Portfolio added')]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Portfolio $portfolio
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Portfolio $portfolio)
    {
        $portfolio->load(['allContents', 'images']);
        $locale = config('app.default_locale');
        $languages = array_keys(LaravelLocalization::getSupportedLocales());
        return view('admin.portfolio.edit', compact('locale', 'portfolio', 'languages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param Portfolio $portfolio
     * @return RedirectResponse
     */
    public function update(UpdateRequest $request, Portfolio $portfolio)
    {
        if ($request->file('image')) {
            if (Storage::disk('public')->exists(config('settings.portfolio.logo.path') . '/' . $portfolio->image)) {
                Storage::disk('public')->delete(config('settings.portfolio.logo.path') . '/' . $portfolio->image);
            }
            $file = $request->file('image');
            $file->store(config('settings.portfolio.logo.path'), 'public');
            $portfolio->image = $file->hashName();
        }
        $portfolio->fill($request->only(['android_link', 'apple_link', 'year']));
        $portfolio->save();
        PortfolioContent::updateOrCreate(
            ['language' => config('app.default_locale'), 'portfolio_id' => $portfolio->id],
            $request->only(['title', 'description', 'text'])
        );

        if (is_array($request->input('delete_images'))) {
            foreach ($request->input('delete_images') as $imageId) {
                $image = PortfolioImage::where('portfolio_id', $portfolio->id)->where('id', $imageId)->first();
                if ($image) {
                    $path = config('settings.portfolio.images.path') . '/' . $image->name;
                    if (Storage::disk('public')->exists($path)) {
                        Storage::disk('public')->delete($path);
                    }
                    $image->delete();
                }
            }
        }

        $images = [];
        if (is_array($request->file('images'))) {
            foreach ($request->file('images') as $uploadImage) {
                $uploadImage->store(config('settings.portfolio.images.path'), 'public');
                $images[] = new PortfolioImage(['name' => $uploadImage->hashName()]);
            }
            $portfolio->images()->saveMany($images);
        }


        return redirect()->back()->with(['success-message' => trans('Portfolio updated')]);

    }

    public function updateLang(UpdateLangRequest $request, Portfolio $portfolio)
    {
        Validator::make($request->all(), [
            'title' => 'required|unique:posts|max:255',
            'body' => 'required',
        ])->validate();
        PortfolioContent::updateOrCreate(
            ['language' => $request->input('language'), 'portfolio_id' => $portfolio->id],
            $request->only(['title', 'description', 'text'])
        );
        return redirect()->back()->with(['success-message' => trans('Portfolio language content updated')]);
    }

    public function destroyLang(Request $request, Portfolio $portfolio)
    {
        PortfolioContent::where(
            [
                ['language', '=', $request->input('language')],
                ['portfolio_id', '=', $portfolio->id]
            ]
        )->delete();
        return redirect()->back()->with(['success-message' => trans('Portfolio language content deleted')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Portfolio $portfolio
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(Portfolio $portfolio)
    {
        if (Storage::disk('public')->exists(config('settings.portfolio.logo.path') . '/' . $portfolio->image)) {
            Storage::disk('public')->delete(config('settings.portfolio.logo.path') . '/' . $portfolio->image);
        }

        foreach ($portfolio->images as $image) {
            $path = config('settings.portfolio.images.path') . '/' . $image->name;
            if (Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }
            $image->delete();
        }
        $portfolio->delete();
        return redirect()->route('admin.portfolio.index')->with('success-message', trans('Portfolio deleted'));
    }
}
