@extends('admin.layout')

@section('title', 'Manage Talents')

@section('content')
<div class="mb-8 flex items-center justify-between">
    <div>
        <h1 class="text-3xl font-bold text-gray-900">Manage Talents</h1>
        <p class="text-gray-600 mt-2">Total: {{ $talents->total() }} talents</p>
    </div>
    <a href="{{ route('admin.talents.create') }}" class="bg-primary text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition">
        + Add New Talent
    </a>
</div>

<div class="bg-white rounded-xl shadow-md overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="text-left py-4 px-6 font-semibold text-gray-700">Name</th>
                    <th class="text-left py-4 px-6 font-semibold text-gray-700">Role</th>
                    <th class="text-left py-4 px-6 font-semibold text-gray-700">Niche</th>
                    <th class="text-left py-4 px-6 font-semibold text-gray-700">Featured</th>
                    <th class="text-left py-4 px-6 font-semibold text-gray-700">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($talents as $talent)
                <tr class="border-b hover:bg-gray-50">
                    <td class="py-4 px-6">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-primary flex items-center justify-center text-white font-bold flex-shrink-0">
                                {{ substr($talent->name, 0, 1) }}
                            </div>
                            <span class="font-semibold">{{ $talent->name }}</span>
                        </div>
                    </td>
                    <td class="py-4 px-6">{{ $talent->role }}</td>
                    <td class="py-4 px-6">
                        <span class="bg-primary text-white px-3 py-1 rounded-full text-xs">{{ $talent->niche }}</span>
                    </td>
                    <td class="py-4 px-6">
                        @if($talent->is_featured)
                        <span class="bg-accent text-primary px-3 py-1 rounded-full text-xs font-semibold">★ Featured</span>
                        @else
                        <span class="text-gray-400 text-xs">Not featured</span>
                        @endif
                    </td>
                    <td class="py-4 px-6">
                        <div class="flex gap-2">
                            <a href="{{ route('talents.show', $talent) }}" target="_blank" class="text-blue-600 hover:text-blue-800 font-semibold text-sm">View</a>
                            <a href="{{ route('admin.talents.edit', $talent) }}" class="text-primary hover:text-blue-800 font-semibold text-sm">Edit</a>
                            <form action="{{ route('admin.talents.destroy', $talent) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this talent?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 font-semibold text-sm">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="py-8 text-center text-gray-500">No talents found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($talents->hasPages())
    <div class="p-6 border-t">
        {{ $talents->links() }}
    </div>
    @endif
</div>
@endsection
