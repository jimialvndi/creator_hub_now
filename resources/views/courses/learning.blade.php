@extends('layouts.app')

@section('title', 'Belajar: ' . $currentLesson->title)

@section('content')
<div class="flex flex-col h-screen bg-indigo-50/50 overflow-hidden">
    
    <header class="bg-white border-b border-gray-200 h-16 flex-shrink-0 flex items-center justify-between px-4 lg:px-6 z-20">
        <div class="flex items-center gap-2 lg:gap-4">
            <a href="{{ route('courses.my') }}" class="p-2 hover:bg-gray-100 rounded-full transition text-gray-500 hover:text-primary" title="Kembali ke Dashboard">
                <svg class="w-5 h-5 lg:w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M10 19l-7-7m0 0l7-7m-7 7h18" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </a>
            <div class="h-8 w-px bg-gray-200 mx-1 lg:mx-2"></div>
            <div>
                <h1 class="text-xs md:text-base font-bold text-gray-900 line-clamp-1">{{ $currentLesson->title }}</h1>
                <p class="text-[9px] md:text-[10px] text-primary uppercase tracking-widest font-black">{{ $course->title }}</p>
            </div>
        </div>
        
        <div class="flex items-center gap-3">
            <a href="{{ route('courses.my') }}" class="text-gray-500 hover:text-red-600 text-[10px] md:text-xs font-bold transition flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                <span class="hidden sm:inline">Tutup Kelas</span>
            </a>
        </div>
    </header>

    <div class="flex flex-col lg:flex-row flex-1 overflow-hidden">
        
        <main class="flex-1 overflow-y-auto custom-scrollbar p-4 lg:p-10">
            <div class="max-w-5xl mx-auto">
                <div class="bg-indigo-100 rounded-2xl overflow-hidden shadow-sm aspect-video border border-indigo-200 relative">
                    @php
                        $videoId = "";
                        if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $currentLesson->youtube_url, $match)) {
                            $videoId = $match[1];
                        }
                    @endphp
                    
                    @if($videoId)
                        <iframe class="w-full h-full" 
                                src="https://www.youtube.com/embed/{{ $videoId }}?rel=0&autoplay=1" 
                                title="{{ $currentLesson->title }}" 
                                frameborder="0" 
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                allowfullscreen>
                        </iframe>
                    @else
                        <div class="w-full h-full flex items-center justify-center text-indigo-400 italic">
                            Video tidak tersedia atau URL tidak valid
                        </div>
                    @endif
                </div>

                <div class="flex justify-between items-center mt-6 lg:mt-8 gap-4">
                    @if(isset($prevLesson))
                        <a href="{{ route('courses.learning', [$course->slug, $prevLesson->id]) }}" 
                           class="flex items-center justify-center gap-2 flex-1 md:flex-none px-4 lg:px-6 py-3 bg-white text-gray-700 border border-gray-200 rounded-xl hover:bg-gray-50 hover:text-primary transition text-xs lg:text-sm font-bold shadow-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15 19l-7-7 7-7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            <span class="hidden sm:inline">Materi Sebelumnya</span>
                            <span class="sm:hidden">Prev</span>
                        </a>
                    @else
                        <div class="flex-1 md:flex-none"></div>
                    @endif

                    @if(isset($nextLesson))
                        <a href="{{ route('courses.learning', [$course->slug, $nextLesson->id]) }}" 
                           class="flex items-center justify-center gap-2 flex-1 md:flex-none px-4 lg:px-6 py-3 bg-primary text-white rounded-xl hover:bg-blue-700 transition text-xs lg:text-sm font-bold shadow-lg shadow-blue-500/20">
                            <span class="hidden sm:inline">Materi Berikutnya</span>
                            <span class="sm:hidden">Next</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 5l7 7-7 7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </a>
                    @else
                        <span class="px-4 lg:px-6 py-3 bg-green-100 text-green-700 rounded-xl text-xs lg:text-sm font-bold border border-green-200 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293l-4 4a1 1 0 01-1.414 0l-2-2a1 1 0 111.414-1.414L9 10.586l3.293-3.293a1 1 0 111.414 1.414z"/></svg>
                            Selesai
                        </span>
                    @endif
                </div>

                <div class="mt-8 lg:mt-12 bg-white p-6 lg:p-8 rounded-2xl shadow-sm border border-gray-100 mb-10">
                    <h2 class="text-lg lg:text-xl font-bold text-gray-900 mb-4 pb-4 border-b">Deskripsi Materi</h2>
                    <div class="prose max-w-none text-sm lg:text-base text-gray-600 leading-relaxed">
                        {!! nl2br(e($course->description)) !!}
                    </div>
                </div>
            </div>
        </main>

        <aside class="w-full lg:w-80 xl:w-96 bg-white border-t lg:border-t-0 lg:border-l border-gray-200 flex flex-col h-64 md:h-80 lg:h-full flex-shrink-0">
            <div class="p-4 lg:p-5 bg-gray-50 border-b flex justify-between items-center">
                <h3 class="font-bold text-gray-800 uppercase tracking-widest text-[10px]">Kurikulum Kelas</h3>
                <span class="text-[10px] font-bold text-primary bg-indigo-50 px-2 py-0.5 rounded">{{ count($lessons) }} Video</span>
            </div>
            
            <div class="flex-1 overflow-y-auto custom-scrollbar">
                @foreach ($lessons as $index => $lesson)
                    <a href="{{ route('courses.learning', [$course->slug, $lesson->id]) }}" 
                       class="flex items-start gap-4 p-4 lg:p-5 hover:bg-indigo-50 transition border-b last:border-0 {{ $currentLesson->id == $lesson->id ? 'bg-indigo-50 border-l-4 border-l-primary' : '' }}">
                        <div class="flex-shrink-0 w-7 h-7 lg:w-8 lg:h-8 rounded-full flex items-center justify-center text-[10px] lg:text-xs font-bold 
                            {{ $currentLesson->id == $lesson->id ? 'bg-primary text-white shadow-md' : 'bg-gray-100 text-gray-400' }}">
                            {{ $index + 1 }}
                        </div>
                        <div class="flex-1">
                            <h4 class="text-xs lg:text-sm font-bold mb-1 leading-tight {{ $currentLesson->id == $lesson->id ? 'text-primary' : 'text-gray-900' }}">
                                {{ $lesson->title }}
                            </h4>
                            <span class="text-[9px] lg:text-[10px] text-gray-400 font-medium">{{ $lesson->duration }}</span>
                        </div>
                    </a>
                @endforeach
            </div>
        </aside>
    </div>
</div>

<style>
    /* Styling scrollbar tipis agar elegan */
    .custom-scrollbar::-webkit-scrollbar { width: 4px; height: 4px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }
    
    /* Menghilangkan scrollbar pada area utama untuk tampilan lebih bersih */
    @media (min-width: 1024px) {
        main::-webkit-scrollbar { width: 0px; }
    }
</style>
@endsection