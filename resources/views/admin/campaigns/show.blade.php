@extends('admin.layout')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.campaigns.index') }}" class="text-gray-500 hover:text-gray-900">&larr; Kembali ke List</a>
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mt-2 gap-4">
        <h1 class="text-3xl font-bold text-gray-800">Campaign: {{ $campaign->campaign_name }}</h1>
        
        <form action="{{ route('admin.campaigns.update', $campaign) }}" method="POST" class="flex items-center gap-2">
            @csrf
            @method('PUT')
            <select name="status" class="rounded-lg border-gray-300 text-sm focus:ring-primary focus:border-primary">
                <option value="pending_payment" {{ $campaign->status == 'pending_payment' ? 'selected' : '' }}>Pending Payment</option>
                <option value="processing" {{ $campaign->status == 'processing' ? 'selected' : '' }}>Processing (Paid)</option>
                <option value="completed" {{ $campaign->status == 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="cancelled" {{ $campaign->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
            <button type="submit" class="bg-primary text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-700 transition">Update Status</button>
        </form>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="space-y-6">
        <div class="bg-white p-6 rounded-xl shadow-sm">
            <h3 class="text-gray-500 text-xs font-bold uppercase tracking-wider mb-4">Informasi Client</h3>
            <div class="space-y-3">
                <div>
                    <span class="block text-sm text-gray-500">Nama Brand</span>
                    <span class="block font-semibold text-gray-900">{{ $campaign->brand_name }}</span>
                </div>
                <div>
                    <span class="block text-sm text-gray-500">Kontak (WA)</span>
                    <a href="https://wa.me/{{ $campaign->brand_whatsapp }}" target="_blank" class="text-primary hover:underline flex items-center gap-1">
                        {{ $campaign->brand_whatsapp }} 
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                    </a>
                </div>
                <div>
                    <span class="block text-sm text-gray-500">Email</span>
                    <span class="block text-gray-900">{{ $campaign->brand_email }}</span>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm">
            <h3 class="text-gray-500 text-xs font-bold uppercase tracking-wider mb-4">Detail Request</h3>
            <div class="space-y-3">
                <div>
                    <span class="block text-sm text-gray-500">Budget</span>
                    <span class="block font-mono font-bold text-lg text-green-600">Rp{{ number_format($campaign->budget, 0, ',', '.') }}</span>
                </div>
                <div>
                    <span class="block text-sm text-gray-500">Platform</span>
                    <span class="block font-semibold">{{ $campaign->platform }}</span>
                </div>
                <div>
                    <span class="block text-sm text-gray-500">Niche</span>
                    <span class="block font-semibold">{{ $campaign->niche }}</span>
                </div>
                <div>
                    <span class="block text-sm text-gray-500">Brief</span>
                    <p class="text-sm text-gray-700 bg-gray-50 p-3 rounded mt-1">{{ $campaign->brief ?? 'Tidak ada brief tertulis.' }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="lg:col-span-2 space-y-6">
        <div class="bg-white p-6 rounded-xl shadow-sm">
            <div class="flex justify-between items-center mb-6">
                <h3 class="font-bold text-lg text-gray-900">Talent Terpilih</h3>
                <span class="text-xs bg-blue-100 text-blue-800 px-2 py-1 rounded">Total: {{ $campaign->talents->count() }} Talent</span>
            </div>

            <div class="space-y-4">
                @foreach($campaign->talents as $talent)
                <div class="flex flex-col sm:flex-row items-center justify-between border p-4 rounded-lg bg-gray-50">
                    <div class="flex items-center gap-4 mb-3 sm:mb-0">
                        <div class="h-12 w-12 bg-gray-300 rounded-full overflow-hidden flex-shrink-0">
                            @if($talent->photo)
                                <img src="{{ Storage::url($talent->photo) }}" class="h-full w-full object-cover">
                            @else
                                <div class="h-full w-full flex items-center justify-center bg-primary text-white font-bold">{{ substr($talent->name, 0, 1) }}</div>
                            @endif
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900">{{ $talent->name }}</h4>
                            <p class="text-xs text-gray-500">{{ $talent->followers_count }} Followers • {{ $talent->niche }}</p>
                            
                            <div class="mt-1">
                                @if($talent->pivot->status == 'pending')
                                    <span class="text-xs text-yellow-600 font-bold bg-yellow-100 px-2 py-0.5 rounded">Menunggu Konfirmasi</span>
                                @elseif($talent->pivot->status == 'accepted')
                                    <span class="text-xs text-green-600 font-bold bg-green-100 px-2 py-0.5 rounded">Siap Kerja</span>
                                @elseif($talent->pivot->status == 'rejected')
                                    <span class="text-xs text-red-600 font-bold bg-red-100 px-2 py-0.5 rounded">Menolak / Batal</span>
                                @elseif($talent->pivot->status == 'completed')
                                    <span class="text-xs text-blue-600 font-bold bg-blue-100 px-2 py-0.5 rounded">Selesai</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('admin.campaigns.talent.update', [$campaign, $talent]) }}" method="POST" class="flex items-center gap-2">
                        @csrf
                        @method('PATCH')
                        <select name="status" class="text-xs rounded border-gray-300">
                            <option value="pending" {{ $talent->pivot->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="accepted" {{ $talent->pivot->status == 'accepted' ? 'selected' : '' }}>Accept</option>
                            <option value="rejected" {{ $talent->pivot->status == 'rejected' ? 'selected' : '' }}>Reject</option>
                            <option value="completed" {{ $talent->pivot->status == 'completed' ? 'selected' : '' }}>Done</option>
                        </select>
                        <button type="submit" class="text-xs bg-gray-200 hover:bg-gray-300 px-3 py-2 rounded transition">Save</button>
                    </form>
                </div>
                @endforeach
            </div>

            <div class="mt-8 pt-6 border-t border-dashed">
                <h4 class="font-bold text-sm text-gray-700 mb-2">Tambah Talent Pengganti (Manual)</h4>
                <p class="text-xs text-gray-500 mb-3">Gunakan fitur ini jika ada talent yang reject dan perlu diganti sesuai Agreement.</p>
                
                <form action="{{ route('admin.campaigns.talent.add', $campaign) }}" method="POST" class="flex gap-2">
                    @csrf
                    <select name="talent_id" class="w-full rounded-lg border-gray-300 text-sm">
                        <option value="">-- Pilih Talent Pengganti --</option>
                        @foreach($allTalents as $t)
                            <option value="{{ $t->id }}">{{ $t->name }} ({{ $t->niche }})</option>
                        @endforeach
                    </select>
                    <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded-lg text-sm hover:bg-black whitespace-nowrap">
                        + Tambah
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection