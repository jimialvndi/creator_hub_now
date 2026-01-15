@extends('layouts.app')

@section('title', 'Hire Talent - UNTAN Creator Hub')

@section('content')
<section class="bg-primary text-white py-16">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-6">Find the Perfect Creator</h1>
        <p class="text-xl text-gray-200 mb-10 max-w-2xl mx-auto">
            Platform talent creator mahasiswa terbesar. Pilih cara kerja yang paling sesuai dengan kebutuhan brand Anda.
        </p>
        
        <div class="flex flex-col md:flex-row justify-center gap-6">
            <a href="#talent-list" class="bg-transparent border-2 border-white text-white px-8 py-4 rounded-xl font-bold hover:bg-white hover:text-primary transition flex items-center justify-center gap-2">
                Hire Talent Individu
            </a>
            <a href="{{ route('campaigns.create') }}" class="bg-accent text-primary px-8 py-4 rounded-xl font-bold shadow-lg hover:bg-yellow-400 hover:scale-105 transition flex items-center justify-center gap-2">
                Buat Campaign Konten
            </a>
        </div>
    </div>
</section>

<section id="talent-list" class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-end mb-8">
            <div>
                <h2 class="text-3xl font-bold text-gray-900">Featured Talents</h2>
                <p class="text-gray-600">Explore our best creators ready to work.</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            @forelse($talents as $talent)
            <div class="bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 group border border-gray-100 flex flex-col h-full">
                <div class="h-64 bg-gray-200 relative overflow-hidden">
                    @if($talent->photo)
                        <img src="{{ Storage::url($talent->photo) }}" alt="{{ $talent->name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    @else
                        <div class="flex items-center justify-center h-full bg-primary text-white text-4xl font-bold">{{ substr($talent->name, 0, 1) }}</div>
                    @endif
                    
                    <div class="absolute top-3 left-3 flex flex-col gap-2">
                        @if($talent->is_featured)
                            <span class="bg-yellow-400 text-primary text-xs font-bold px-2 py-1 rounded shadow">FEATURED</span>
                        @endif
                        <span class="bg-black/60 backdrop-blur text-white text-xs px-2 py-1 rounded">{{ $talent->niche }}</span>
                    </div>
                </div>

                <div class="p-5 flex flex-col flex-1">
                    <h3 class="text-lg font-bold text-gray-900 leading-tight mb-1">{{ $talent->name }}</h3>
                    <p class="text-sm text-gray-500 mb-3">{{ $talent->role }}</p>
                    
                    <div class="mt-auto pt-4 border-t border-gray-100">
                        <p class="text-xs text-gray-400 uppercase font-semibold mb-1">Estimasi Rate</p>
                        <p class="text-primary font-bold text-lg mb-4">
                            Rp{{ number_format($talent->rate_min, 0, ',', '.') }} - 
                            Rp{{ number_format($talent->rate_max, 0, ',', '.') }}
                        </p>

                        <div class="grid grid-cols-2 gap-3">
                            <a href="{{ route('talents.show', $talent) }}" class="text-center py-2 px-3 border border-gray-300 rounded-lg text-gray-700 font-semibold text-sm hover:bg-gray-50 transition">
                                Lihat Profil
                            </a>
                            <a href="https://wa.me/6281234567890?text=Halo%20Admin,%20saya%20tertarik%20hire%20talent%20{{ urlencode($talent->name) }}" target="_blank" class="text-center py-2 px-3 bg-primary text-white rounded-lg font-semibold text-sm hover:bg-blue-700 transition">
                                Hire Now
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-10">Belum ada talent terdaftar.</div>
            @endforelse
        </div>
        
        <div class="mt-8">
            {{ $talents->links() }}
        </div>
    </div>
</section>
@endsection