@extends('layouts.app')

@section('title', 'Class Dashboard - UNTAN Creator Hub')

@section('content')
<div class="flex h-screen bg-gray-100 overflow-hidden" x-data="{ sidebarOpen: false }">
    
    <div x-show="sidebarOpen" 
         @click="sidebarOpen = false" 
         class="fixed inset-0 z-40 bg-black/50 transition-opacity md:hidden"
         x-transition:enter="transition-opacity ease-linear duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-linear duration-300"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">
    </div>

    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" 
           class="fixed inset-y-0 left-0 z-50 w-64 bg-primary text-white transform transition-transform duration-300 ease-in-out md:relative md:translate-x-0 flex flex-col flex-shrink-0">
        
        <div class="p-6 flex items-center justify-between">
            <a href="{{ route('home') }}" class="text-xl font-bold flex items-center gap-2">
                <span class="text-accent">★</span> Hub Dashboard
            </a>
            <button @click="sidebarOpen = false" class="md:hidden text-white">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </button>
        </div>
        
        <nav class="flex-1 px-4 space-y-2 py-4">
            <a href="{{ route('courses.my') }}" class="flex items-center gap-3 p-3 bg-white/10 rounded-lg font-bold">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                My Classes
            </a>
            <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 p-3 hover:bg-white/5 rounded-lg transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM4 21v-2a4 4 0 014-4h8a4 4 0 014 4v2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                Profile Settings
            </a>
        </nav>

        <div class="p-4 border-t border-white/10">
            <a href="{{ route('home') }}" class="flex items-center gap-3 p-3 text-accent hover:text-white transition font-semibold">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M10 19l-7-7m0 0l7-7m-7 7h18" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                Back to Website
            </a>
        </div>
    </aside>

    <main class="flex-1 overflow-y-auto">
        <header class="bg-white shadow-sm p-4 flex justify-between items-center sticky top-0 z-30">
            <div class="flex items-center gap-3">
                <button @click="sidebarOpen = true" class="md:hidden text-gray-600 hover:text-primary focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 6h16M4 12h16M4 18h16" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </button>
                <h1 class="text-lg md:text-xl font-bold text-gray-800 line-clamp-1">Halo, {{ Auth::user()->name }}!</h1>
            </div>
            <div class="flex items-center gap-2">
                <span class="text-[10px] md:text-xs font-bold px-2 py-1 bg-accent text-primary rounded uppercase">{{ Auth::user()->role }}</span>
            </div>
        </header>

        <div class="p-4 md:p-8">
            <div class="mb-6 md:mb-8">
                <h2 class="text-xl md:text-2xl font-bold text-gray-900">Kelas Saya</h2>
                <p class="text-sm text-gray-500">Pilih kelas untuk melanjutkan progres belajar Anda.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-4 md:gap-6">
                @forelse($courses as $course)
                    <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden hover:shadow-lg transition-shadow duration-300 group flex flex-col">
                        <div class="relative h-40 md:h-44 overflow-hidden flex-shrink-0">
                            <img src="{{ $course->thumbnail ? asset('storage/' . $course->thumbnail) : 'https://via.placeholder.com/600x400' }}" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition duration-500"
                                 alt="{{ $course->title }}">
                            <div class="absolute bottom-2 right-2 bg-black/60 text-white text-[10px] px-2 py-1 rounded backdrop-blur border border-white/20">
                                {{ $course->lessons_count }} Materi
                            </div>
                        </div>
                        <div class="p-4 md:p-5 flex-1 flex flex-col">
                            <h3 class="font-bold text-gray-900 mb-2 line-clamp-1 group-hover:text-primary transition-colors">{{ $course->title }}</h3>
                            <p class="text-gray-500 text-xs mb-4 line-clamp-2 leading-relaxed flex-1">{{ $course->description }}</p>
                            <a href="{{ route('courses.start', $course->slug) }}" class="flex justify-center items-center w-full py-2.5 bg-primary text-white rounded-xl font-bold text-sm hover:bg-blue-700 transition-all active:scale-95">
                                Buka Kelas
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full bg-white p-10 md:p-16 rounded-2xl border border-dashed border-gray-300 text-center flex flex-col items-center gap-3">
                        <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        <p class="text-gray-500 italic text-sm">Belum ada kelas yang tersedia untuk akun Anda.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </main>
</div>
@endsection