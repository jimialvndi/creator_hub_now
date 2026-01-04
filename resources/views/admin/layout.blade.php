<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Admin Panel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
        // Fallback jika vite belum build css
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#1E5BFF',
                        accent: '#FFF200',
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-gray-100 font-sans antialiased">
    <div class="flex h-screen overflow-hidden">

        <aside class="w-64 bg-white border-r border-gray-200 hidden md:flex flex-col">
            <div class="h-16 flex items-center px-6 border-b border-gray-200">
                <span class="text-xl font-bold text-primary">Creat<span class="text-accent">*</span>r Hub</span>
            </div>

            <nav class="flex-1 overflow-y-auto py-4">
                <ul class="space-y-1 px-3">
                    <li>
                        <a href="{{ route('admin.dashboard') }}"
                            class="flex items-center px-3 py-2.5 rounded-lg transition group {{ request()->routeIs('admin.dashboard') ? 'bg-primary text-white' : 'text-gray-700 hover:bg-blue-50 hover:text-primary' }}">
                            <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.dashboard') ? 'text-white' : 'text-gray-400 group-hover:text-primary' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                            </svg>
                            Dashboard
                        </a>
                    </li>

                    <li class="pt-4 pb-2 px-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">Master Data</li>

                    <li>
                        <a href="{{ route('admin.talents.index') }}"
                            class="flex items-center px-3 py-2.5 rounded-lg transition group {{ request()->routeIs('admin.talents.*') ? 'bg-primary text-white' : 'text-gray-700 hover:bg-blue-50 hover:text-primary' }}">
                            <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.talents.*') ? 'text-white' : 'text-gray-400 group-hover:text-primary' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            Manage Talents
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('admin.users.index') }}"
                            class="flex items-center px-3 py-2.5 rounded-lg transition group {{ request()->routeIs('admin.users.*') ? 'bg-primary text-white' : 'text-gray-700 hover:bg-blue-50 hover:text-primary' }}">
                            <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.users.*') ? 'text-white' : 'text-gray-400 group-hover:text-primary' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                            Manage Users
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('admin.courses.index') }}"
                            class="flex items-center px-3 py-2.5 rounded-lg transition group {{ request()->routeIs('admin.courses.*') ? 'bg-primary text-white' : 'text-gray-700 hover:bg-blue-50 hover:text-primary' }}">
                            <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.courses.*') ? 'text-white' : 'text-gray-400 group-hover:text-primary' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            Kelas Online
                        </a>
                    </li>

                    <li class="pt-4 pb-2 px-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">General</li>

                    <li>
                        <a href="{{ route('admin.contacts') }}"
                            class="flex items-center px-3 py-2.5 rounded-lg transition group {{ request()->routeIs('admin.contacts') ? 'bg-primary text-white' : 'text-gray-700 hover:bg-blue-50 hover:text-primary' }}">
                            <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.contacts') ? 'text-white' : 'text-gray-400 group-hover:text-primary' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            Inbox / Pesan
                            @if(\App\Models\Contact::where('is_read', false)->count() > 0)
                            <span class="ml-auto bg-red-500 text-white text-[10px] px-2 py-0.5 rounded-full">{{ \App\Models\Contact::where('is_read', false)->count() }}</span>
                            @endif
                        </a>
                    </li>
                </ul>
            </nav>

            <div class="p-4 border-t border-gray-200">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-primary text-white flex items-center justify-center font-bold">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 truncate">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-500 truncate">Administrator</p>
                    </div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="text-gray-400 hover:text-red-600 transition" title="Logout">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <main class="flex-1 flex flex-col h-screen overflow-hidden bg-gray-100">
            <header class="bg-white border-b border-gray-200 md:hidden flex items-center justify-between p-4">
                <span class="text-xl font-bold text-primary">Creator Hub</span>
                <button class="text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </header>

            <div class="flex-1 overflow-auto p-6 md:p-8">
                @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow-sm" role="alert">
                    <p class="font-bold">Success</p>
                    <p>{{ session('success') }}</p>
                </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>
</body>

</html>