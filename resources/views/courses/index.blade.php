@extends('layouts.app')

@section('title', 'Katalog Kelas Online - UNTAN Creator Hub')

@section('content')
<section class="bg-primary text-white py-20">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-5xl font-bold mb-4">Katalog Kelas Online</h1>
        <p class="text-xl text-gray-300">Tingkatkan keahlian digital Anda melalui materi eksklusif dari para ahli</p>
    </div>
</section>

<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($courses as $course)
            <div class="bg-white rounded-xl overflow-hidden shadow-md hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 group flex flex-col">
                <div class="relative h-48 overflow-hidden bg-gray-200">
                    <img src="{{ $course->thumbnail ? asset('storage/' . $course->thumbnail) : 'https://via.placeholder.com/600x400?text=No+Image' }}" 
                         alt="{{ $course->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                    <div class="absolute top-4 left-4">
                        <span class="px-3 py-1 text-xs font-bold rounded-full shadow-sm uppercase 
                            {{ $course->access_level == 'free' ? 'bg-green-100 text-green-800' : ($course->access_level == 'member' ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800') }}">
                            {{ $course->access_level }}
                        </span>
                    </div>
                </div>
                
                <div class="p-6 flex-1 flex flex-col">
                    <div class="flex items-center gap-2 mb-3 text-sm text-gray-500">
                        <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                        {{ $course->lessons_count }} Materi
                    </div>

                    <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $course->title }}</h3>
                    <p class="text-gray-600 text-sm mb-6 line-clamp-2 flex-1">{{ $course->description }}</p>

                    <a href="{{ route('courses.show', $course->slug) }}" 
                       class="block w-full text-center bg-primary text-white py-3 rounded-lg font-semibold hover:bg-blue-700 transition group-hover:bg-accent group-hover:text-primary uppercase tracking-wider text-xs">
                        Lihat Detail
                    </a>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-12">
                <p class="text-gray-500 text-lg italic">Belum ada kelas yang tersedia saat ini.</p>
            </div>
            @endforelse
        </div>

        @if($courses->hasPages())
        <div class="mt-12">
            {{ $courses->links() }}
        </div>
        @endif
    </div>
</section>
@endsection