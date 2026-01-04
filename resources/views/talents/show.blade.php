@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen pb-12">
    <div class="bg-white shadow-sm border-b">
        <div class="container mx-auto px-4 py-8">
            <div class="flex flex-col md:flex-row items-center gap-8">
                <div class="flex-shrink-0">
                    <div class="w-32 h-32 md:w-40 md:h-40 rounded-full overflow-hidden border-4 border-white shadow-lg relative">
                        @if($talent->photo)
                            <img src="{{ asset('storage/' . $talent->photo) }}" alt="{{ $talent->name }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-500 text-2xl font-bold">
                                {{ substr($talent->name, 0, 1) }}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="text-center md:text-left flex-grow">
                    <div class="flex flex-col md:flex-row items-center gap-3 mb-2">
                        <h1 class="text-3xl font-bold text-gray-900">{{ $talent->name }}</h1>
                        @if($talent->is_featured)
                            <span class="bg-accent text-primary text-xs font-bold px-2 py-1 rounded-full uppercase tracking-wide">Featured</span>
                        @endif
                    </div>
                    
                    <p class="text-xl text-primary font-medium mb-4">{{ $talent->role }}</p>
                    
                    <div class="flex flex-wrap items-center justify-center md:justify-start gap-4 text-sm text-gray-600">
                        <div class="flex items-center gap-1 bg-blue-50 text-blue-700 px-3 py-1 rounded-lg">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            <span class="font-bold">{{ number_format($talent->followers_count) }}</span> Followers
                        </div>
                        
                        <div class="h-4 w-px bg-gray-300 mx-2 hidden md:block"></div>

                        <div class="flex gap-3">
                            @if($talent->instagram)
                                <a href="{{ $talent->instagram }}" target="_blank" class="text-pink-600 hover:text-pink-800 transition"><span class="sr-only">Instagram</span>IG</a>
                            @endif
                            @if($talent->tiktok)
                                <a href="{{ $talent->tiktok }}" target="_blank" class="text-black hover:text-gray-700 transition"><span class="sr-only">TikTok</span>TT</a>
                            @endif
                            @if($talent->youtube)
                                <a href="{{ $talent->youtube }}" target="_blank" class="text-red-600 hover:text-red-800 transition"><span class="sr-only">YouTube</span>YT</a>
                            @endif
                            @if($talent->linkedin)
                                <a href="{{ $talent->linkedin }}" target="_blank" class="text-blue-700 hover:text-blue-900 transition"><span class="sr-only">LinkedIn</span>IN</a>
                            @endif
                            @if($talent->email)
                                <a href="mailto:{{ $talent->email }}" class="text-gray-600 hover:text-primary transition"><span class="sr-only">Email</span>@</a>
                            @endif
                        </div>
                    </div>
                </div>

                <div>
                    <a href="{{ route('contact.index') }}" class="bg-primary text-white px-8 py-3 rounded-full font-bold hover:bg-blue-700 transition shadow-lg shadow-blue-500/30">
                        Hire Me
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <div class="lg:col-span-1 space-y-8">
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h3 class="font-bold text-gray-900 text-lg mb-4 border-b pb-2">About</h3>
                    <div class="prose prose-blue text-gray-600 text-sm">
                        {{ $talent->bio }}
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h3 class="font-bold text-gray-900 text-lg mb-4 border-b pb-2">Niche & Interests</h3>
                    
                    <div class="mb-4">
                        <span class="text-xs font-bold text-gray-400 uppercase tracking-wider block mb-2">Main Niche</span>
                        <span class="inline-block bg-blue-100 text-primary text-sm font-semibold px-3 py-1 rounded-full">
                            {{ $talent->niche }}
                        </span>
                    </div>

                    @if(!empty($talent->interests))
                        <div>
                            <span class="text-xs font-bold text-gray-400 uppercase tracking-wider block mb-2">Interests</span>
                            <div class="flex flex-wrap gap-2">
                                @foreach($talent->interests as $interest)
                                    <span class="inline-block bg-gray-100 text-gray-600 text-xs font-medium px-2 py-1 rounded">
                                        {{ $interest }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h3 class="font-bold text-gray-900 text-lg mb-4 border-b pb-2">Skills</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach($talent->skills as $skill)
                            <span class="inline-block border border-gray-200 text-gray-700 text-sm font-medium px-3 py-1 rounded-lg">
                                {{ $skill }}
                            </span>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="lg:col-span-2 space-y-8">
                
                @if(!empty($talent->portfolio))
                <div>
                    <h3 class="font-bold text-gray-900 text-xl mb-6 flex items-center gap-2">
                        <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        Featured Portfolio
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach($talent->portfolio as $item)
                            <a href="{{ $item['link'] ?? '#' }}" target="_blank" class="group block bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-md transition border border-gray-100">
                                <div class="aspect-video bg-gray-100 relative overflow-hidden">
                                    @if(!empty($item['thumbnail']))
                                        <img src="{{ asset('storage/' . $item['thumbnail']) }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                    @else
                                        <div class="flex items-center justify-center h-full text-gray-400">
                                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        </div>
                                    @endif
                                    
                                    <div class="absolute top-2 right-2 bg-black/50 text-white p-1 rounded-full opacity-0 group-hover:opacity-100 transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                    </div>
                                </div>
                                <div class="p-4">
                                    <h4 class="font-bold text-gray-900 group-hover:text-primary transition">{{ $item['title'] ?? 'Untitled Project' }}</h4>
                                    <p class="text-xs text-gray-500 mt-1">Click to view project</p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @if($talent->experience)
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <h3 class="font-bold text-gray-900 text-lg mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            Experience
                        </h3>
                        <p class="text-gray-600 text-sm whitespace-pre-line">{{ $talent->experience }}</p>
                    </div>
                    @endif

                    @if($talent->achievements)
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <h3 class="font-bold text-gray-900 text-lg mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
                            Achievements
                        </h3>
                        <p class="text-gray-600 text-sm whitespace-pre-line">{{ $talent->achievements }}</p>
                    </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>
@endsection