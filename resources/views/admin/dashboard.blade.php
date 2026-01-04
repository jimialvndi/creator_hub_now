@extends('admin.layout')

@section('title', 'Dashboard')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-bold text-gray-900">Dashboard</h1>
    <p class="text-gray-600 mt-2">Welcome back, {{ auth()->user()->name }}!</p>
</div>

<!-- Stats -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
    <div class="bg-white p-6 rounded-xl shadow-md border-l-4 border-primary">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-semibold">Total Talents</p>
                <p class="text-3xl font-bold text-primary mt-2">{{ $talentsCount }}</p>
            </div>
            <div class="text-primary text-4xl">
                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
            </div>
        </div>
    </div>

    <div class="bg-white p-6 rounded-xl shadow-md border-l-4 border-accent">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-semibold">Unread Messages</p>
                <p class="text-3xl font-bold text-gray-900 mt-2">{{ $contactsCount }}</p>
            </div>
            <div class="text-accent text-4xl">
                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
            </div>
        </div>
    </div>
</div>

<!-- Recent Talents -->
<div class="bg-white rounded-xl shadow-md p-6">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-xl font-bold text-gray-900">Recent Talents</h2>
        <a href="{{ route('admin.talents.index') }}" class="text-primary hover:text-blue-700 font-semibold">View All →</a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="border-b">
                    <th class="text-left py-3 px-4 font-semibold text-gray-700">Name</th>
                    <th class="text-left py-3 px-4 font-semibold text-gray-700">Role</th>
                    <th class="text-left py-3 px-4 font-semibold text-gray-700">Niche</th>
                    <th class="text-left py-3 px-4 font-semibold text-gray-700">Added</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recentTalents as $talent)
                <tr class="border-b hover:bg-gray-50">
                    <td class="py-3 px-4">{{ $talent->name }}</td>
                    <td class="py-3 px-4">{{ $talent->role }}</td>
                    <td class="py-3 px-4">
                        <span class="bg-primary text-white px-3 py-1 rounded-full text-xs">{{ $talent->niche }}</span>
                    </td>
                    <td class="py-3 px-4 text-gray-600">{{ $talent->created_at->diffForHumans() }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
