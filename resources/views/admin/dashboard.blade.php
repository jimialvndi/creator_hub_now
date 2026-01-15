@extends('admin.layout')

@section('title', 'Dashboard')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-bold text-gray-900">Welcome Back, Admin! 👋</h1>
    <p class="text-gray-600">Here is what's happening with your platform today.</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-gray-500 text-sm font-bold uppercase">Total Talents</h3>
            <span class="bg-blue-100 text-blue-600 p-2 rounded-lg">⭐</span>
        </div>
        <p class="text-3xl font-bold text-gray-900">{{ $talentsCount }}</p>
    </div>

    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-gray-500 text-sm font-bold uppercase">Active Campaigns</h3>
            <span class="bg-purple-100 text-purple-600 p-2 rounded-lg">🚀</span>
        </div>
        <p class="text-3xl font-bold text-gray-900">{{ $campaignCount }}</p>
        <p class="text-xs text-gray-500 mt-1">
            <span class="text-orange-500 font-bold">{{ $pendingCampaigns }}</span> pending payment
        </p>
    </div>

    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-gray-500 text-sm font-bold uppercase">Inbox</h3>
            <span class="bg-green-100 text-green-600 p-2 rounded-lg">📩</span>
        </div>
        <p class="text-3xl font-bold text-gray-900">{{ $contactsCount }}</p>
        <p class="text-xs text-gray-500 mt-1">Unread messages</p>
    </div>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="p-6 border-b border-gray-100 flex justify-between items-center">
        <h3 class="font-bold text-gray-900">Newest Talents</h3>
        <a href="{{ route('admin.talents.index') }}" class="text-sm text-blue-600 hover:underline">View All</a>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-gray-50">
                <tr>
                    <th class="p-4 text-sm font-semibold text-gray-600">Name</th>
                    <th class="p-4 text-sm font-semibold text-gray-600">Role</th>
                    <th class="p-4 text-sm font-semibold text-gray-600">Joined</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentTalents as $talent)
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-4 font-bold text-gray-800">{{ $talent->name }}</td>
                    <td class="p-4 text-gray-600">{{ $talent->role }}</td>
                    <td class="p-4 text-sm text-gray-500">{{ $talent->created_at->diffForHumans() }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="p-6 text-center text-gray-500">No talents joined yet.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection