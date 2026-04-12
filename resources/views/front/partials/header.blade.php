@php
    use App\Models\Menu;
    use App\Models\Setting;
    use App\Models\ThemeSetting;

    $menu = Menu::where('location', 'header')->with(['items' => function($q) {
        $q->orderBy('order');
    }])->first();
    $settings = $settings ?? Setting::pluck('value', 'key')->toArray();
    $theme = $theme ?? ThemeSetting::first();
    $menuItems = $menu ? $menu->items->where('parent_id', null)->sortBy('order') : collect();

    if (!function_exists('renderHeaderMenu')) {
        function renderHeaderMenu($items) {
            if ($items->isEmpty()) return '';
            $html = '<ul class="dropdown-menu">';
            foreach ($items as $item) {
                $html .= '<li>';
                $html .= '<a href="'.url($item->url).'" class="dropdown-item">'.$item->title.'</a>';
                $html .= '</li>';
            }
            $html .= '</ul>';
            return $html;
        }
    }
@endphp

<header class="header">
    <div class="container navbar">
        <div class="brand">
            <a href="{{ url('/') }}" style="display:flex; align-items:center; color:inherit;">
                @if($theme && $theme->logo_path)
                    <img src="{{ asset('storage/'.$theme->logo_path) }}" alt="{{ $settings['site_title'] ?? config('app.name') }}" style="height:200px; margin-right:12px;">
                @endif
               
            </a>
        </div>

        <nav class="nav-links">
            @foreach($menuItems as $item)
                @php $hasChildren = $item->children && $item->children->count() > 0; @endphp
                <div class="nav-item">
                    <a href="{{ url($item->url) }}" class="nav-link">
                        {{ $item->title }}
                        @if($hasChildren)
                            <i class="fa fa-chevron-down" style="font-size:0.7rem; margin-left:4px;"></i>
                        @endif
                    </a>
                    @if($hasChildren)
                        {!! renderHeaderMenu($item->children->sortBy('order')) !!}
                    @endif
                </div>
            @endforeach
            <a href="{{ url('/contact-us') }}" class="btn btn-primary">Get Started</a>
        </nav>

        <button class="mobile-toggle">
            <i class="fa fa-bars"></i>
        </button>
    </div>

    <!-- Mobile Menu -->
    <div class="mobile-nav">
        @foreach($menuItems as $item)
            @php $hasChildren = $item->children && $item->children->count() > 0; @endphp
            <div class="nav-item">
                <a href="{{ url($item->url) }}" class="nav-link">{{ $item->title }}</a>
                @if($hasChildren)
                    {!! renderHeaderMenu($item->children->sortBy('order')) !!}
                @endif
            </div>
        @endforeach
        <div style="padding: 1rem 1.5rem;">
            <a href="{{ url('/contact-us') }}" class="btn btn-primary" style="width: 100%;">Get Started</a>
        </div>
    </div>
</header>