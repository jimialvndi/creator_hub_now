@extends('layouts.app')

@section('title', 'All Talents - UNTAN Creator Hub')

@section('content')
<!-- Page Header -->
<section class="bg-primary text-white py-20">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-5xl font-bold mb-4">Our Talented Creators</h1>
        <p class="text-xl text-gray-300">Discover amazing student creators ready to collaborate</p>
    </div>
</section>

<!-- Talents Grid -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            @forelse($talents as $talent)
            <div class="bg-white rounded-xl overflow-hidden shadow-md hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 group">
                <!-- Profile Photo -->
                <div class="h-56 bg-gradient-to-br from-primary to-blue-700 flex items-center justify-center relative overflow-hidden">
                    @if($talent->photo)
                        <img src="{{ Storage::url($talent->photo) }}" alt="{{ $talent->name }}" class="w-full h-full object-cover">
                    @else
                        <div class="text-white text-5xl font-bold">{{ substr($talent->name, 0, 1) }}</div>
                    @endif
                    <div class="absolute inset-0 bg-primary opacity-0 group-hover:opacity-20 transition-opacity"></div>
                </div>

                <!-- Content -->
                <div class="p-5">
                    <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $talent->name }}</h3>
                    <p class="text-primary font-semibold mb-3">{{ $talent->role }}</p>
                    
                    <!-- Skills -->
                    <div class="flex flex-wrap gap-2 mb-4">
                        @foreach(array_slice($talent->skills_array, 0, 3) as $skill)
                        <span class="bg-gray-100 text-gray-700 px-2 py-1 rounded-full text-xs">{{ $skill }}</span>
                        @endforeach
                    </div>

                    <a href="{{ route('talents.show', $talent) }}" class="block w-full text-center bg-primary text-white py-2 rounded-lg font-semibold hover:bg-blue-700 transition group-hover:bg-accent group-hover:text-primary">
                        View Profile
                    </a>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-12">
                <p class="text-gray-500 text-lg">No talents found.</p>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($talents->hasPages())
        <div class="mt-12">
            {{ $talents->links() }}
        </div>
        @endif
    </div>
</section>
@endsection
