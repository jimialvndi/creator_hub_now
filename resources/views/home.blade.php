@extends('layouts.app')

@section('title', 'Home - UNTAN Creator Hub')

@section('content')
<!-- Hero Section -->
<section class="min-h-screen bg-primary flex items-center justify-center relative overflow-hidden">
    <!-- Decorative stars -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-20 left-10 text-accent text-6xl">★</div>
        <div class="absolute top-40 right-20 text-accent text-4xl">★</div>
        <div class="absolute bottom-40 left-1/4 text-accent text-5xl">★</div>
        <div class="absolute bottom-20 right-1/3 text-accent text-3xl">★</div>
    </div>

    <div class="container mx-auto px-4 text-center relative z-10">
        <h1 class="text-5xl md:text-7xl font-bold text-white mb-6 leading-tight">
            Where UNTAN Creators<br>Grow & Get Seen
        </h1>
        <p class="text-xl md:text-2xl text-gray-300 mb-12 max-w-3xl mx-auto leading-relaxed">
            A curated hub of student content creators managed by UNTAN — ready to collaborate, inspire, and create impact.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
            <a href="{{ route('talents.index') }}" class="bg-accent text-primary px-8 py-4 rounded-full font-bold text-lg hover:bg-yellow-300 transition transform hover:scale-105">
                Explore Talents
            </a>
            <a href="{{ route('about') }}" class="border-2 border-white text-white px-8 py-4 rounded-full font-bold text-lg hover:bg-white hover:text-primary transition">
                Creator Program
            </a>
        </div>
    </div>
</section>

<!-- Featured Talents Section -->
<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-primary mb-4">Featured Talents</h2>
            <p class="text-gray-600 text-lg">Meet our amazing creators</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
            @foreach($talents as $talent)
            <div class="bg-white rounded-xl overflow-hidden shadow-md hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 group">
                <!-- Profile Photo -->
                <div class="h-64 bg-gradient-to-br from-primary to-blue-700 flex items-center justify-center relative overflow-hidden">
                    @if($talent->photo)
                        <img src="{{ Storage::url($talent->photo) }}" alt="{{ $talent->name }}" class="w-full h-full object-cover">
                    @else
                        <div class="text-white text-6xl font-bold">{{ substr($talent->name, 0, 1) }}</div>
                    @endif
                    <div class="absolute inset-0 bg-primary opacity-0 group-hover:opacity-20 transition-opacity"></div>
                </div>

                <!-- Content -->
                <div class="p-6">
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">{{ $talent->name }}</h3>
                    <p class="text-primary font-semibold mb-3">{{ $talent->role }}</p>
                    
                    <!-- Skills -->
                    <div class="flex flex-wrap gap-2 mb-4">
                        @foreach(array_slice($talent->skills_array, 0, 3) as $skill)
                        <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm">{{ $skill }}</span>
                        @endforeach
                    </div>

                    <a href="{{ route('talents.show', $talent) }}" class="block w-full text-center bg-primary text-white py-3 rounded-lg font-semibold hover:bg-blue-700 transition group-hover:bg-accent group-hover:text-primary">
                        View Profile
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-center">
            <a href="{{ route('talents.index') }}" class="inline-block bg-primary text-white px-8 py-4 rounded-full font-bold text-lg hover:bg-blue-700 transition">
                View All Talents
            </a>
        </div>
    </div>
</section>

<!-- About Preview Section -->
<section class="py-20 bg-primary text-white">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-4xl font-bold mb-6">What is UNTAN Creator Hub?</h2>
            <p class="text-xl text-gray-300 mb-8 leading-relaxed">
                A platform dedicated to showcasing, managing, and promoting talented student content creators from Universitas Tanjungpura. 
                We believe in the power of student creativity and provide them with opportunities to grow, collaborate, and make an impact.
            </p>
            <a href="{{ route('about') }}" class="inline-block bg-accent text-primary px-8 py-4 rounded-full font-bold text-lg hover:bg-yellow-300 transition">
                Learn More About Us
            </a>
        </div>
    </div>
</section>

<!-- Call to Action Section -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-4xl font-bold text-primary mb-6">Ready to Collaborate?</h2>
            <p class="text-xl text-gray-600 mb-8">
                Connect with our talented creators and bring your ideas to life
            </p>
            <a href="{{ route('contact.index') }}" class="inline-block bg-accent text-primary px-8 py-4 rounded-full font-bold text-lg hover:bg-yellow-300 transition">
                Get in Touch
            </a>
        </div>
    </div>
</section>
@endsection
