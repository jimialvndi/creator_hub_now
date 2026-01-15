@extends('admin.layout')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h1 class="text-3xl font-bold text-gray-800">Manajemen Campaign</h1>
</div>

<div class="bg-white rounded-xl shadow-sm overflow-hidden">
    <table class="w-full text-left border-collapse">
        <thead class="bg-gray-50 border-b">
            <tr>
                <th class="p-4 text-sm font-semibold text-gray-600">Tanggal</th>
                <th class="p-4 text-sm font-semibold text-gray-600">Brand / Client</th>
                <th class="p-4 text-sm font-semibold text-gray-600">Campaign</th>
                <th class="p-4 text-sm font-semibold text-gray-600">Budget</th>
                <th class="p-4 text-sm font-semibold text-gray-600">Status</th>
                <th class="p-4 text-sm font-semibold text-gray-600">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($campaigns as $campaign)
            <tr class="hover:bg-gray-50 transition">
                <td class="p-4 text-sm text-gray-500">{{ $campaign->created_at->format('d M Y') }}</td>
                <td class="p-4">
                    <div class="font-bold text-gray-900">{{ $campaign->brand_name }}</div>
                    <div class="text-xs text-gray-500">{{ $campaign->brand_whatsapp }}</div>
                </td>
                <td class="p-4 text-gray-800">{{ $campaign->campaign_name }}</td>
                <td class="p-4 font-mono text-sm">Rp{{ number_format($campaign->budget, 0, ',', '.') }}</td>
                <td class="p-4">
                    @if($campaign->status == 'pending_payment')
                        <span class="bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded-full font-bold">Menunggu Bayar</span>
                    @elseif($campaign->status == 'processing')
                        <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full font-bold">Sedang Jalan</span>
                    @elseif($campaign->status == 'completed')
                        <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full font-bold">Selesai</span>
                    @else
                        <span class="bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded-full font-bold">{{ $campaign->status }}</span>
                    @endif
                </td>
                <td class="p-4">
                    <a href="{{ route('admin.campaigns.show', $campaign) }}" class="text-primary hover:text-blue-700 font-semibold text-sm">Kelola &rarr;</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="p-8 text-center text-gray-500">Belum ada campaign masuk.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    
    <div class="p-4 border-t">
        {{ $campaigns->links() }}
    </div>
</div>
@endsection