@php
    $navItems = [
        [
            'label' => 'Dashboard',
            'icon' => 'fa-gauge-high',
            'route' => 'admin.dashboard',
        ],
        [
            'label' => 'Pages',
            'icon' => 'fa-file-lines',
            'route' => 'admin.pages.index',
        ],
        [
            'label' => 'Services',
            'icon' => 'fa-briefcase',
            'route' => 'admin.services.index',
        ],
        [
            'label' => 'Portfolio',
            'icon' => 'fa-folder-open',
            'route' => 'admin.portfolio.index',
        ],
        [
            'label' => 'Blog',
            'icon' => 'fa-blog',
            'children' => [
                ['label' => 'Posts', 'route' => 'admin.blogs.index'],
                ['label' => 'Categories', 'route' => 'admin.blog-categories.index'],
                ['label' => 'Tags', 'route' => 'admin.blog-tags.index'],
            ],
        ],
        [
            'label' => 'Menus',
            'icon' => 'fa-bars',
            'children' => [
                ['label' => 'All Menus', 'route' => 'admin.menus.index'],
                ['label' => 'Add Menu Item', 'route' => 'admin.menu-items.create'],
            ],
        ],
        [
            'label' => 'Footer',
            'icon' => 'fa-shoe-prints',
            'children' => [
                ['label' => 'Sections', 'route' => 'admin.footer-sections.index'],
                ['label' => 'Links', 'route' => 'admin.footer-links.index'],
            ],
        ],
        [
            'label' => 'Settings',
            'icon' => 'fa-gear',
            'children' => [
                ['label' => 'General', 'route' => 'admin.settings.general'],
                ['label' => 'Theme', 'route' => 'admin.settings.theme'],
                ['label' => 'SEO', 'route' => 'admin.settings.seo'],
                ['label' => 'Social Links', 'route' => 'admin.social-links.index'],
                ['label' => 'Firebase', 'route' => 'admin.settings.firebase'],
            ],
        ],
        [
            'label' => 'Media',
            'icon' => 'fa-photo-film',
            'route' => 'admin.media.index',
        ],
        [
            'label' => 'Subscribers',
            'icon' => 'fa-envelope-open-text',
            'route' => 'admin.subscribers.index',
        ],
        [
            'label' => 'Contact Messages',
            'icon' => 'fa-message',
            'route' => 'admin.contacts.index',
        ],
    ];
@endphp

<aside class="w-64 bg-white shadow-md">
    <div class="p-4 border-b flex items-center justify-between">
        <a href="{{ route('admin.dashboard') }}" class="text-xl font-bold text-blue-600">
            {{ config('app.name') }}
        </a>
    </div>
    <nav class="p-4 space-y-2">
        @foreach($navItems as $item)
            @if(isset($item['children']))
                <div x-data="{ open: request()->routeIs(collect($item['children'])->pluck('route')->toArray()) }" class="mb-2">
                    <button type="button" class="flex items-center w-full px-3 py-2 text-gray-700 hover:bg-gray-100 rounded" @click="open = !open">
                        <i class="fa {{ $item['icon'] }} mr-3"></i>
                        <span class="flex-1 text-left">{{ $item['label'] }}</span>
                        <i class="fa fa-chevron-down transform transition-transform" :class="{ 'rotate-180': open }"></i>
                    </button>
                    <div x-show="open" class="ml-6 mt-1 space-y-1" x-cloak>
                        @foreach($item['children'] as $child)
                            <a href="{{ route($child['route']) }}" class="block px-3 py-2 text-sm rounded {{ request()->routeIs($child['route']) ? 'bg-blue-100 text-blue-700' : 'text-gray-600 hover:bg-gray-50' }}">
                                {{ $child['label'] }}
                            </a>
                        @endforeach
                    </div>
                </div>
            @else
                <a href="{{ route($item['route']) }}" class="flex items-center px-3 py-2 rounded {{ request()->routeIs($item['route']) ? 'bg-blue-100 text-blue-700' : 'text-gray-700 hover:bg-gray-100' }}">
                    <i class="fa {{ $item['icon'] }} mr-3"></i>
                    <span>{{ $item['label'] }}</span>
                </a>
            @endif
        @endforeach
    </nav>
</aside>