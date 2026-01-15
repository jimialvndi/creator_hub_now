<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Admin Creator Hub</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        /* Fallback sederhana jika Vite belum jalan */
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-gray-100 font-sans antialiased">
    <div class="flex h-screen overflow-hidden">

        <aside class="w-64 bg-white border-r border-gray-200 hidden md:flex flex-col">
            <div class="h-16 flex items-center px-6 border-b border-gray-200">
                <span class="text-xl font-bold text-primary">Creator<span class="text-yellow-400">*</span>Hub</span>
            </div>

            <nav class="flex-1 overflow-y-auto py-4">
                <ul class="space-y-1 px-3">
                    <li>
                        <a href="{{ route('admin.dashboard') }}" 
                           class="flex items-center px-3 py-2.5 rounded-lg transition {{ request()->routeIs('admin.dashboard') ? 'bg-blue-50 text-blue-600 font-bold' : 'text-gray-600 hover:bg-gray-50' }}">
                            <span class="mr-3">📊</span> Dashboard
                        </a>
                    </li>

                    <li class="pt-4 pb-2 px-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">Campaign & Order</li>

                    <li>
                        <a href="{{ route('admin.campaigns.index') }}" 
                           class="flex items-center px-3 py-2.5 rounded-lg transition {{ request()->routeIs('admin.campaigns.*') ? 'bg-blue-50 text-blue-600 font-bold' : 'text-gray-600 hover:bg-gray-50' }}">
                            <span class="mr-3">🚀</span> Campaigns
                            
                            @php
                                // Logika AMAN: Cek dulu apakah tabel ada, baru hitung
                                $pendingCount = 0;
                                try {
                                    if(class_exists('\App\Models\Campaign')) {
                                        $pendingCount = \App\Models\Campaign::where('status', 'pending_payment')->count();
                                    }
                                } catch (\Exception $e) { $pendingCount = 0; }
                            @endphp

                            @if($pendingCount > 0)
                                <span class="ml-auto bg-red-500 text-white text-xs font-bold px-2 py-0.5 rounded-full">{{ $pendingCount }}</span>
                            @endif
                        </a>
                    </li>

                    <li class="pt-4 pb-2 px-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">Master Data</li>

                    <li>
                        <a href="{{ route('admin.talents.index') }}" 
                           class="flex items-center px-3 py-2.5 rounded-lg transition {{ request()->routeIs('admin.talents.*') ? 'bg-blue-50 text-blue-600 font-bold' : 'text-gray-600 hover:bg-gray-50' }}">
                            <span class="mr-3">⭐</span> Talents
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('admin.users.index') }}" 
                           class="flex items-center px-3 py-2.5 rounded-lg transition {{ request()->routeIs('admin.users.*') ? 'bg-blue-50 text-blue-600 font-bold' : 'text-gray-600 hover:bg-gray-50' }}">
                            <span class="mr-3">👥</span> Users
                        </a>
                    </li>
                    
                    <li>
                        <a href="{{ route('admin.courses.index') }}" 
                           class="flex items-center px-3 py-2.5 rounded-lg transition {{ request()->routeIs('admin.courses.*') ? 'bg-blue-50 text-blue-600 font-bold' : 'text-gray-600 hover:bg-gray-50' }}">
                            <span class="mr-3">🎓</span> Courses
                        </a>
                    </li>

                    <li class="pt-4 pb-2 px-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">General</li>

                    <li>
                        <a href="{{ route('admin.contacts') }}" 
                           class="flex items-center px-3 py-2.5 rounded-lg transition {{ request()->routeIs('admin.contacts') ? 'bg-blue-50 text-blue-600 font-bold' : 'text-gray-600 hover:bg-gray-50' }}">
                            <span class="mr-3">📩</span> Inbox
                            
                            @php
                                $unreadCount = 0;
                                try {
                                    if(class_exists('\App\Models\Contact')) {
                                        $unreadCount = \App\Models\Contact::where('is_read', false)->count();
                                    }
                                } catch (\Exception $e) { $unreadCount = 0; }
                            @endphp

                            @if($unreadCount > 0)
                                <span class="ml-auto bg-red-500 text-white text-xs font-bold px-2 py-0.5 rounded-full">{{ $unreadCount }}</span>
                            @endif
                        </a>
                    </li>
                </ul>
            </nav>

            <div class="p-4 border-t border-gray-200">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold">
                        {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 truncate">{{ Auth::user()->name ?? 'Admin' }}</p>
                        <p class="text-xs text-gray-500 truncate">Administrator</p>
                    </div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="text-gray-400 hover:text-red-600 transition" title="Logout">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <main class="flex-1 flex flex-col h-screen overflow-hidden bg-gray-100">
            <header class="bg-white border-b border-gray-200 md:hidden flex items-center justify-between p-4">
                <span class="text-xl font-bold text-blue-600">Creator Hub</span>
                </header>

            <div class="flex-1 overflow-auto p-6 md:p-8">
                @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow-sm" role="alert">
                    <p class="font-bold">Success</p>
                    <p>{{ session('success') }}</p>
                </div>
                @endif
                
                @if(session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded shadow-sm" role="alert">
                    <p class="font-bold">Error</p>
                    <p>{{ session('error') }}</p>
                </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>