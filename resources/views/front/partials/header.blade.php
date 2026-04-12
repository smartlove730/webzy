@php
    use App\Models\Menu;
    use App\Models\Setting;
    use App\Models\ThemeSetting;
    
    // Retrieve menu assigned to header
    $menu = Menu::where('location', 'header')->with(['items' => function($q) {
        $q->orderBy('order');
    }])->first();
    $settings = $settings ?? Setting::pluck('value', 'key')->toArray();
    $theme = $theme ?? ThemeSetting::first();
    $menuItems = $menu ? $menu->items->where('parent_id', null)->sortBy('order') : collect();
    
    function renderMenu($items) {
        if ($items->isEmpty()) return '';
        $html = '<ul class="dropdown-menu">';
        foreach ($items as $item) {
            $hasChildren = $item->children && $item->children->count() > 0;
            $html .= '<li>';
            $html .= '<a href="'.url($item->url).'" class="dropdown-item">'.$item->title.'</a>';
            if ($hasChildren) {
                // If deep nesting is needed, we could call renderMenu again recursively
                // $html .= renderMenu($item->children->sortBy('order'));
            }
            $html .= '</li>';
        }
        $html .= '</ul>';
        return $html;
    }
@endphp

<header class="header" style="position:relative;">
    <div class="container navbar">
        <div class="brand">
            <a href="{{ url('/') }}" style="display:flex; align-items:center; color:inherit;">
                @if($theme && $theme->logo_path)
                    <img src="{{ asset('storage/'.$theme->logo_path) }}" style="height: 200px;" alt="{{ $settings['site_title'] ?? config('app.name') }}">
                @endif
                
            </a>
        </div>
        
        <nav class="nav-links">
            @foreach($menuItems as $item)
                @php $hasChildren = $item->children && $item->children->count() > 0; @endphp
                <div class="nav-item">
                    <a href="{{ url($item->url) }}" class="nav-link">
                        {{ $item->title }}
                        @if($hasChildren) <i class="fa fa-chevron-down" style="font-size:0.75rem;"></i> @endif
                    </a>
                    @if($hasChildren)
                        {!! renderMenu($item->children->sortBy('order')) !!}
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
                    {!! renderMenu($item->children->sortBy('order')) !!}
                @endif
            </div>
        @endforeach
        <div style="padding: 1rem 1.5rem;">
            <a href="{{ url('/contact-us') }}" class="btn btn-primary" style="width: 100%;">Get Started</a>
        </div>
    </div>
</header>