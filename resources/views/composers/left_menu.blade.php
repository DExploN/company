@foreach($leftMenu as $menu)
    <li>
        <a class="menu__link @if(isset($pathWithoutPrefix)) {{strpos($pathWithoutPrefix,$menu->active_path)===0 ? 'menu__link-active':'' }} @endif "
           href="{{ LaravelLocalization::localizeUrl($menu->path) }}">
            <i class="menu__link-picture {{$menu->fa_code}} fa-fw"></i>@lang($menu->title)</a></li>
@endforeach
