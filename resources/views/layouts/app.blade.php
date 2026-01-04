<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'UNTAN Creator Hub') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-50 text-gray-900 flex flex-col min-h-screen">
        
        <nav x-data="{ open: false, userDropdown: false }" class="fixed top-0 left-0 right-0 h-16 bg-white border-b border-gray-200 z-50">
            <div class="container mx-auto px-4 h-full flex items-center justify-between">
                <a href="{{ route('home') }}" class="flex items-center">
                    <span class="text-xl font-bold text-primary">UNTAN creat<span class="text-accent">*</span>r hub.</span>
                </a>

                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-primary transition font-medium">Home</a>
                    <a href="{{ route('talents.index') }}" class="text-gray-700 hover:text-primary transition font-medium">Talents</a>
                    <a href="#" class="text-gray-700 hover:text-primary transition font-medium">
                        Kelas Online <span class="text-[10px] align-top bg-red-100 text-red-600 px-1 rounded ml-0.5">New</span>
                    </a>

                    @auth
                        <div class="relative ml-3">
                            <button @click="userDropdown = !userDropdown" @click.outside="userDropdown = false" class="flex items-center gap-2 text-gray-700 font-semibold hover:text-primary focus:outline-none transition">
                                <div>{{ Auth::user()->name }}</div>
                                @if(Auth::user()->role === 'admin')
                                    <span class="bg-black text-white text-[10px] px-2 py-0.5 rounded-full uppercase tracking-wider">Admin</span>
                                @elseif(Auth::user()->role === 'pro_member')
                                    <span class="bg-accent text-primary text-[10px] px-2 py-0.5 rounded-full font-bold">PRO</span>
                                @endif
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>

                            <div x-show="userDropdown" 
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="transform opacity-0 scale-95"
                                 x-transition:enter-end="transform opacity-100 scale-100"
                                 x-transition:leave="transition ease-in duration-75"
                                 class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl border border-gray-100 py-1" 
                                 style="display: none;">
                                
                                <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Dashboard</a>
                                @if(Auth::user()->role === 'admin')
                                    <a href="{{ route('admin.talents.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Manage Talents</a>
                                @endif
                                <div class="border-t border-gray-100"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-50">
                                        Log Out
                                    </a>
                                </form>
                            </div>
                        </div>
                    @else
                        <div class="flex items-center gap-4">
                            <a href="{{ route('login') }}" class="text-gray-700 font-semibold hover:text-primary">Login</a>
                            <a href="{{ route('register') }}" class="bg-primary text-white px-5 py-2 rounded-full font-bold hover:bg-blue-700 transition shadow-lg shadow-blue-500/30">
                                Register
                            </a>
                        </div>
                    @endauth
                </div>

                <button @click="open = !open" class="md:hidden text-gray-700 focus:outline-none">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div :class="{'block': open, 'hidden': ! open}" class="hidden md:hidden bg-white border-t border-gray-200">
                <div class="px-4 py-4 flex flex-col space-y-3">
                    <a href="{{ route('home') }}" class="block text-gray-700 hover:text-primary py-2">Home</a>
                    <a href="{{ route('talents.index') }}" class="block text-gray-700 hover:text-primary py-2">Talents</a>
                    @auth
                        <div class="border-t border-gray-200 pt-3 mt-2">
                            <div class="font-medium text-base text-gray-800 px-2">{{ Auth::user()->name }}</div>
                            <a href="{{ route('dashboard') }}" class="block px-2 py-2 text-gray-700 hover:text-primary mt-2">Dashboard</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="block px-2 py-2 text-red-600 font-semibold">Log Out</a>
                            </form>
                        </div>
                    @else
                        <div class="grid grid-cols-2 gap-4 mt-4">
                            <a href="{{ route('login') }}" class="text-center py-2 text-gray-700 border border-gray-300 rounded-lg">Login</a>
                            <a href="{{ route('register') }}" class="text-center py-2 bg-primary text-white rounded-lg">Register</a>
                        </div>
                    @endauth
                </div>
            </div>
        </nav>

        <main class="pt-16 flex-grow">
            {{-- Header (Khusus Dashboard Breeze) --}}
            @isset($header)
                <header class="bg-white shadow relative z-10">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            {{-- LOGIKA HYBRID: Cek Slot atau Yield --}}
            @if(isset($slot) && $slot->isNotEmpty())
                {{-- Ini untuk halaman Dashboard/Profile Breeze --}}
                <div class="py-6">
                    {{ $slot }}
                </div>
            @else
                {{-- Ini untuk halaman Home/Talents Lama --}}
                @yield('content')
            @endif
        </main>
        
        <footer class="bg-primary text-white py-12 mt-auto">
            <div class="container mx-auto px-4">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
                    <div>
                        <div class="flex items-center mb-4">
                            <span class="text-xl font-bold">UNTAN creat<span class="text-accent">*</span>r hub.</span>
                        </div>
                        <p class="text-sm text-gray-300">Empowering Student Creators</p>
                    </div>
                    <div>
                        <h4 class="font-bold mb-4">Quick Links</h4>
                        <ul class="space-y-2 text-sm text-gray-300">
                            <li><a href="{{ route('talents.index') }}" class="hover:text-accent transition">Talents</a></li>
                            <li><a href="#" class="hover:text-accent transition">Kelas Online</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="font-bold mb-4">Contact</h4>
                        <p class="text-sm text-gray-300">Pontianak, Kalimantan Barat</p>
                    </div>
                </div>
                <div class="border-t border-blue-700 pt-8 text-center text-sm text-gray-300">
                    <p>&copy; {{ date('Y') }} UNTAN Creator Hub.</p>
                </div>
            </div>
        </footer>
    </body>
</html>