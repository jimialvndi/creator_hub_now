@extends('layouts.app')

@section('title', $talent->name . ' - Profile')

@section('content')
<div class="bg-gray-50 min-h-screen pb-20">
    <div class="h-48 bg-gradient-to-r from-primary to-blue-800"></div>

    <div class="container mx-auto px-4 -mt-24 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden p-6 text-center">
                    <div class="w-40 h-40 mx-auto rounded-full border-4 border-white shadow-md overflow-hidden -mt-16 bg-gray-200 mb-4">
                        @if($talent->photo)
                            <img src="{{ Storage::url($talent->photo) }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-primary flex items-center justify-center text-white text-4xl font-bold">{{ substr($talent->name, 0, 1) }}</div>
                        @endif
                    </div>
                    
                    <h1 class="text-2xl font-bold text-gray-900">{{ $talent->name }}</h1>
                    <p class="text-gray-500 font-medium mb-2">{{ $talent->role }}</p>
                    <span class="inline-block bg-blue-50 text-primary px-3 py-1 rounded-full text-sm font-bold mb-6">
                        {{ $talent->niche }}
                    </span>

                    <div class="border-t border-b py-4 mb-6">
                        <p class="text-xs text-gray-400 uppercase font-bold mb-1">Rate Card Range</p>
                        <p class="text-2xl font-bold text-gray-800">
                            Rp{{ number_format($talent->rate_min, 0, ',', '.') }} <span class="text-sm text-gray-400 font-normal">s/d</span>
                        </p>
                        <p class="text-xl font-bold text-gray-800">
                            Rp{{ number_format($talent->rate_max, 0, ',', '.') }}
                        </p>
                    </div>

                    <a href="https://wa.me/6281234567890?text=Halo%20Admin,%20saya%20tertarik%20hire%20talent%20{{ urlencode($talent->name) }}" target="_blank" class="block w-full bg-primary text-white font-bold py-3 rounded-xl hover:bg-blue-700 transition shadow-lg shadow-blue-500/30 mb-3">
                        Contact to Hire
                    </a>
                    
                    <div class="flex justify-center gap-4 mt-4">
                        @if($talent->instagram) <a href="{{ $talent->instagram }}" target="_blank" class="text-gray-400 hover:text-pink-600"><span class="sr-only">IG</span>📷</a> @endif
                        @if($talent->tiktok) <a href="{{ $talent->tiktok }}" target="_blank" class="text-gray-400 hover:text-black"><span class="sr-only">TT</span>🎵</a> @endif
                        @if($talent->youtube) <a href="{{ $talent->youtube }}" target="_blank" class="text-gray-400 hover:text-red-600"><span class="sr-only">YT</span>▶️</a> @endif
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-sm p-6 mt-6">
                    <h3 class="font-bold text-gray-900 mb-4">Skills & Interests</h3>
                    <div class="flex flex-wrap gap-2 mb-4">
                        @foreach($talent->skills as $skill)
                            <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-lg text-sm">{{ $skill }}</span>
                        @endforeach
                    </div>
                    @if($talent->interests)
                    <p class="text-sm text-gray-500">
                        <span class="font-bold">Interests:</span> {{ implode(', ', $talent->interests) }}
                    </p>
                    @endif
                </div>
            </div>

            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white rounded-2xl shadow-sm p-8">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">About Creator</h2>
                    <p class="text-gray-600 leading-relaxed whitespace-pre-line">{{ $talent->bio }}</p>
                    
                    @if($talent->experience)
                    <div class="mt-6 pt-6 border-t">
                        <h3 class="font-bold text-gray-900 mb-2">Experience</h3>
                        <p class="text-gray-600 text-sm whitespace-pre-line">{{ $talent->experience }}</p>
                    </div>
                    @endif

                    @if($talent->achievements)
                    <div class="mt-6 pt-6 border-t">
                        <h3 class="font-bold text-gray-900 mb-2">Achievements</h3>
                        <p class="text-gray-600 text-sm whitespace-pre-line">{{ $talent->achievements }}</p>
                    </div>
                    @endif
                </div>

                @if(!empty($talent->portfolio))
                <div>
                    <h2 class="text-xl font-bold text-gray-900 mb-4 ml-2">Portfolio Highlights</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach($talent->portfolio as $item)
                        <a href="{{ $item['link'] ?? '#' }}" target="_blank" class="block bg-white rounded-xl shadow-sm overflow-hidden hover:shadow-md transition group">
                            <div class="h-48 bg-gray-200 relative">
                                @if(!empty($item['thumbnail']))
                                    <img src="{{ Storage::url($item['thumbnail']) }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                @else
                                    <div class="flex items-center justify-center h-full text-gray-400">No Image</div>
                                @endif
                                <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition"></div>
                            </div>
                            <div class="p-4">
                                <h3 class="font-bold text-gray-900 group-hover:text-primary transition">{{ $item['title'] }}</h3>
                                <p class="text-xs text-gray-500 mt-1 flex items-center gap-1">
                                    View Project &nearr;
                                </p>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection