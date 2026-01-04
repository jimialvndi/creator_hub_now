@extends('layouts.app')

@section('title', $talent->name . ' - UNTAN Creator Hub')

@section('content')
<!-- Profile Header -->
<section class="bg-primary text-white py-16">
    <div class="container mx-auto px-4">
        <div class="flex flex-col md:flex-row items-center md:items-start gap-8">
            <!-- Profile Photo -->
            <div class="w-48 h-48 rounded-full bg-gradient-to-br from-accent to-yellow-400 flex items-center justify-center shadow-2xl flex-shrink-0 overflow-hidden">
                @if($talent->photo)
                    <img src="{{ Storage::url($talent->photo) }}" alt="{{ $talent->name }}" class="w-full h-full object-cover">
                @else
                    <div class="text-primary text-7xl font-bold">{{ substr($talent->name, 0, 1) }}</div>
                @endif
            </div>

            <!-- Profile Info -->
            <div class="flex-1 text-center md:text-left">
                <h1 class="text-4xl md:text-5xl font-bold mb-2">{{ $talent->name }}</h1>
                <p class="text-xl text-accent mb-4">{{ $talent->tagline }}</p>
                
                <!-- Social Media Links -->
                <div class="flex gap-4 justify-center md:justify-start mb-6">
                    @if($talent->instagram)
                    <a href="{{ $talent->instagram }}" target="_blank" class="text-white hover:text-accent transition">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073z"/><path d="M12 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                    </a>
                    @endif
                    @if($talent->tiktok)
                    <a href="{{ $talent->tiktok }}" target="_blank" class="text-white hover:text-accent transition">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.74 2.89 2.89 0 0 1 2.31-4.64 2.93 2.93 0 0 1 .88.13V9.4a6.84 6.84 0 0 0-1-.05A6.33 6.33 0 0 0 5 20.1a6.34 6.34 0 0 0 10.86-4.43v-7a8.16 8.16 0 0 0 4.77 1.52v-3.4a4.85 4.85 0 0 1-1-.1z"/></svg>
                    </a>
                    @endif
                    @if($talent->youtube)
                    <a href="{{ $talent->youtube }}" target="_blank" class="text-white hover:text-accent transition">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                    </a>
                    @endif
                    @if($talent->linkedin)
                    <a href="{{ $talent->linkedin }}" target="_blank" class="text-white hover:text-accent transition">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                    </a>
                    @endif
                </div>

                <a href="{{ route('contact.index') }}" class="inline-block bg-accent text-primary px-8 py-3 rounded-full font-bold hover:bg-yellow-300 transition">
                    Request Collaboration
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Profile Details -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto space-y-12">
            <!-- About -->
            <div>
                <h2 class="text-3xl font-bold text-primary mb-4 flex items-center gap-2">
                    <span class="text-accent">★</span> About the Creator
                </h2>
                <p class="text-gray-700 text-lg leading-relaxed">{{ $talent->bio }}</p>
            </div>

            <!-- Niche & Interests -->
            <div>
                <h2 class="text-3xl font-bold text-primary mb-4 flex items-center gap-2">
                    <span class="text-accent">★</span> Niche & Interests
                </h2>
                <div class="flex flex-wrap gap-3">
                    <span class="bg-primary text-white px-4 py-2 rounded-full font-semibold">{{ $talent->niche }}</span>
                    @if($talent->interests_array)
                        @foreach($talent->interests_array as $interest)
                        <span class="bg-gray-100 text-gray-700 px-4 py-2 rounded-full">{{ $interest }}</span>
                        @endforeach
                    @endif
                </div>
            </div>

            <!-- Skills -->
            <div>
                <h2 class="text-3xl font-bold text-primary mb-4 flex items-center gap-2">
                    <span class="text-accent">★</span> Skills
                </h2>
                <div class="flex flex-wrap gap-3">
                    @foreach($talent->skills_array as $skill)
                    <span class="bg-accent text-primary px-4 py-2 rounded-full font-semibold">{{ $skill }}</span>
                    @endforeach
                </div>
            </div>

            <!-- Experience -->
            @if($talent->experience)
            <div>
                <h2 class="text-3xl font-bold text-primary mb-4 flex items-center gap-2">
                    <span class="text-accent">★</span> Experience
                </h2>
                <p class="text-gray-700 text-lg leading-relaxed">{{ $talent->experience }}</p>
            </div>
            @endif

            <!-- Portfolio -->
            @if($talent->portfolio_array && count($talent->portfolio_array) > 0)
            <div>
                <h2 class="text-3xl font-bold text-primary mb-4 flex items-center gap-2">
                    <span class="text-accent">★</span> Portfolio
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach($talent->portfolio_array as $item)
                    <div class="bg-gray-50 p-6 rounded-xl border-2 border-gray-200 hover:border-primary transition">
                        <p class="text-gray-800 font-medium">{{ $item }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Achievements -->
            @if($talent->achievements)
            <div>
                <h2 class="text-3xl font-bold text-primary mb-4 flex items-center gap-2">
                    <span class="text-accent">★</span> Achievements
                </h2>
                <div class="bg-accent bg-opacity-10 p-6 rounded-xl border-2 border-accent">
                    <p class="text-gray-800 text-lg">{{ $talent->achievements }}</p>
                </div>
            </div>
            @endif
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-16 bg-primary text-white">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold mb-4">Interested in Collaborating?</h2>
        <p class="text-xl text-gray-300 mb-8">Let's work together and create something amazing</p>
        <a href="{{ route('contact.index') }}" class="inline-block bg-accent text-primary px-8 py-3 rounded-full font-bold hover:bg-yellow-300 transition">
            Get in Touch
        </a>
    </div>
</section>
@endsection
