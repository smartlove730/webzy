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
    // Helper to build nested menus
    function renderMenu($items) {
        if ($items->isEmpty()) return '';
        $html = '<ul class="space-y-2">';
        foreach ($items as $item) {
            $hasChildren = $item->children && $item->children->count() > 0;
            $html .= '<li class="relative group">';
            $html .= '<a href="'.url($item->url).'" class="block px-2 py-1 text-gray-700 hover:text-primary">'.$item->title.'</a>';
            if ($hasChildren) {
                $html .= '<div class="absolute left-0 mt-1 hidden group-hover:block bg-white shadow-lg rounded">'.renderMenu($item->children->sortBy('order')).'</div>';
            }
            $html .= '</li>';
        }
        $html .= '</ul>';
        return $html;
    }
@endphp

<header x-data="{ mobileOpen: false }" class="bg-white shadow">
    <div class="container mx-auto px-6 py-4 flex justify-between items-center">
        <div class="flex items-center">
            <a href="{{ url('/') }}" class="flex items-center">
                @if($theme && $theme->logo_path)
                    <img src="{{ asset('storage/'.$theme->logo_path) }}" alt="{{ $settings['site_title'] ?? config('app.name') }}" class="h-10 mr-3">
                @endif
                <span class="text-2xl font-bold text-gray-800">{{ $settings['site_title'] ?? config('app.name') }}</span>
            </a>
        </div>
        <!-- Desktop Menu -->
        <nav class="hidden lg:flex items-center space-x-6">
            @foreach($menuItems as $item)
                @php $hasChildren = $item->children && $item->children->count() > 0; @endphp
                <div class="relative group">
                    <a href="{{ url($item->url) }}" class="text-gray-700 hover:text-primary px-2 py-1 font-medium flex items-center">
                        {{ $item->title }}
                        @if($hasChildren)
                            <i class="fa fa-chevron-down ml-1 text-xs"></i>
                        @endif
                    </a>
                    @if($hasChildren)
                        <div class="absolute left-0 z-40 mt-2 w-48 bg-white border border-gray-200 shadow-lg rounded hidden group-hover:block">
                            {!! renderMenu($item->children->sortBy('order')) !!}
                        </div>
                    @endif
                </div>
            @endforeach
        </nav>
        <!-- CTA Button on desktop -->
        <div class="hidden lg:flex">
            <a href="{{ url('/contact-us') }}" class="btn-primary px-4 py-2 rounded">Get Started</a>
        </div>
        <!-- Mobile menu toggle -->
        <button @click="mobileOpen = !mobileOpen" class="lg:hidden text-gray-700 hover:text-primary focus:outline-none">
            <i class="fa" :class="mobileOpen ? 'fa-xmark' : 'fa-bars'" class="text-2xl"></i>
        </button>
    </div>
    <!-- Mobile Menu -->
    <div x-show="mobileOpen" x-cloak class="lg:hidden bg-white border-t border-gray-200">
        <nav class="px-6 py-4 space-y-2">
            @foreach($menuItems as $item)
                @php $hasChildren = $item->children && $item->children->count() > 0; @endphp
                <div>
                    <a href="{{ url($item->url) }}" class="block px-2 py-1 text-gray-700 hover:text-primary font-medium">{{ $item->title }}</a>
                    @if($hasChildren)
                        <div class="ml-4 mt-1 space-y-1">
                            @foreach($item->children->sortBy('order') as $child)
                                <a href="{{ url($child->url) }}" class="block px-2 py-1 text-gray-600 hover:text-primary">{{ $child->title }}</a>
                            @endforeach
                        </div>
                    @endif
                </div>
            @endforeach
            <a href="{{ url('/contact-us') }}" class="block mt-2 px-2 py-2 bg-primary text-white text-center rounded">Get Started</a>
        </nav>
    </div>
</header>