@extends('layouts.app')

@section('title', $course->title . ' - UNTAN Creator Hub')

@section('content')
<section class="bg-primary text-white py-12">
    <div class="container mx-auto px-4">
        <nav class="mb-4 text-sm text-gray-300">
            <a href="{{ route('home') }}" class="hover:text-white">Home</a> / 
            <a href="{{ route('courses.index') }}" class="hover:text-white">Kelas Online</a> / 
            <span class="text-white">{{ $course->title }}</span>
        </nav>
        <h1 class="text-4xl font-bold">{{ $course->title }}</h1>
    </div>
</section>

<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            
            <div class="md:col-span-1">
                <div class="sticky top-24">
                    <div class="bg-white p-4 rounded-2xl shadow-md border border-gray-100">
                        <img src="{{ $course->thumbnail ? asset('storage/' . $course->thumbnail) : 'https://via.placeholder.com/600x400?text=No+Image' }}" 
                             alt="{{ $course->title }}" class="w-full rounded-xl mb-6 object-cover aspect-video">
                        
                        <div class="space-y-4 mb-6">
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600">Akses Kelas</span>
                                <span class="px-3 py-1 text-xs font-bold rounded-full 
                                    {{ $course->access_level == 'free' ? 'bg-green-100 text-green-800' : ($course->access_level == 'member' ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800') }}">
                                    {{ strtoupper($course->access_level) }}
                                </span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600">Total Materi</span>
                                <span class="text-sm font-bold text-gray-900">{{ $course->lessons->count() }} Video</span>
                            </div>
                        </div>

                        @if (session('error'))
                            <div class="mb-4 p-3 bg-red-50 border-l-4 border-red-500 text-red-700 text-xs">
                                {{ session('error') }}
                            </div>
                        @endif

                        <a href="{{ route('courses.my') }}" 
                           class="block w-full text-center px-6 py-4 bg-primary text-white rounded-xl font-bold uppercase tracking-widest hover:bg-blue-700 transition shadow-lg shadow-blue-500/20">
                            Mulai Belajar
                        </a>
                    </div>
                </div>
            </div>

            <div class="md:col-span-2">
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
                    <div class="mb-10">
                        <h3 class="text-2xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                            <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Tentang Kelas
                        </h3>
                        <div class="prose max-w-none text-gray-600 leading-relaxed">
                            {{ $course->description }}
                        </div>
                    </div>

                    <div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-2">
                            <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                            Kurikulum Kelas
                        </h3>
                        <div class="space-y-3">
                            @forelse ($course->lessons as $index => $lesson)
                                <div class="flex items-center justify-between p-4 bg-gray-50 border border-transparent rounded-xl hover:border-primary/30 transition group">
                                    <div class="flex items-center gap-4">
                                        <div class="flex-shrink-0 w-10 h-10 rounded-full bg-white text-primary flex items-center justify-center font-bold shadow-sm group-hover:bg-primary group-hover:text-white transition">
                                            {{ $index + 1 }}
                                        </div>
                                        <div>
                                            <h4 class="font-bold text-gray-800">{{ $lesson->title }}</h4>
                                            <p class="text-xs text-gray-500">{{ $lesson->duration }}</p>
                                        </div>
                                    </div>
                                    <div class="text-gray-400 group-hover:text-primary transition">
                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path></svg>
                                    </div>
                                </div>
                            @empty
                                <p class="text-center py-8 text-gray-500 italic">Materi belum tersedia.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection