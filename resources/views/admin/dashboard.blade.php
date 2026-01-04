@extends('admin.layout')

@section('title', 'Dashboard')

@section('content')
<div class="mb-8">
    <h1 class="text-2xl font-bold text-gray-800">Dashboard Overview</h1>
    <p class="text-gray-500">Selamat datang kembali, Master Admin.</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-gray-500 text-sm font-medium">Total Talent</h3>
            <span class="bg-blue-100 text-primary p-2 rounded-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            </span>
        </div>
        <p class="text-3xl font-bold text-gray-900">{{ \App\Models\Talent::count() }}</p>
    </div>

    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-gray-500 text-sm font-medium">Total User</h3>
            <span class="bg-green-100 text-green-600 p-2 rounded-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
            </span>
        </div>
        <p class="text-3xl font-bold text-gray-900">{{ \App\Models\User::count() }}</p>
    </div>

    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-gray-500 text-sm font-medium">Pesan Masuk</h3>
            <span class="bg-purple-100 text-purple-600 p-2 rounded-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
            </span>
        </div>
        <p class="text-3xl font-bold text-gray-900">{{ \App\Models\Contact::where('is_read', false)->count() }}</p>
    </div>
</div>

<h2 class="text-lg font-bold text-gray-800 mb-4">Menu Pengelolaan</h2>
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <a href="{{ route('admin.talents.index') }}" class="group block bg-white p-6 rounded-xl border border-gray-200 hover:border-primary hover:shadow-md transition">
        <div class="flex items-center gap-4">
            <div class="bg-blue-50 text-primary p-3 rounded-full group-hover:bg-primary group-hover:text-white transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            </div>
            <div>
                <h3 class="font-bold text-gray-900">Kelola Talents</h3>
                <p class="text-sm text-gray-500">Tambah, edit, atau hapus profil talent.</p>
            </div>
        </div>
    </a>

    <a href="{{ route('admin.users.index') }}" class="group block bg-white p-6 rounded-xl border border-gray-200 hover:border-primary hover:shadow-md transition">
        <div class="flex items-center gap-4">
            <div class="bg-green-50 text-green-600 p-3 rounded-full group-hover:bg-green-600 group-hover:text-white transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
            </div>
            <div>
                <h3 class="font-bold text-gray-900">Kelola Users</h3>
                <p class="text-sm text-gray-500">Atur role user (Free, Member, Pro).</p>
            </div>
        </div>
    </a>

    <a href="{{ route('admin.contacts') }}" class="group block bg-white p-6 rounded-xl border border-gray-200 hover:border-primary hover:shadow-md transition">
        <div class="flex items-center gap-4">
            <div class="bg-purple-50 text-purple-600 p-3 rounded-full group-hover:bg-purple-600 group-hover:text-white transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
            </div>
            <div>
                <h3 class="font-bold text-gray-900">Inbox Pesan</h3>
                <p class="text-sm text-gray-500">Lihat pesan dari formulir kontak.</p>
            </div>
        </div>
    </a>
</div>
@endsection