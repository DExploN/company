<?php


namespace App\Http\View\Composers;


use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class LeftMenuComposer
{
    private $request;

    Public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function compose(View $view)
    {
        $path = Str::start($this->request->path(), '/');
        $prefix = $this->request->route()->getAction('prefix') ?? null;
        $prefix .= '/';
        $pathWithoutPrefix = null;
        if (strpos($path, $prefix) === 0) {
            $pathWithoutPrefix = substr($path, strlen($prefix));
        }
        $view->with('leftMenu', Menu::orderBy('sort')->get())->with('pathWithoutPrefix', $pathWithoutPrefix);
    }
}
