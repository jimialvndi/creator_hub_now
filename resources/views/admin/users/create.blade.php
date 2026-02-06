@extends('admin.layout')

@section('title', 'Tambah User Baru')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-6 flex items-center justify-between">
        <h1 class="text-2xl font-bold text-gray-800">Tambah User Baru</h1>
        <a href="{{ route('admin.users.index') }}" class="text-gray-600 hover:text-gray-900 font-medium">
            &larr; Kembali
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 md:p-8">
        <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name') }}" class="w-full rounded-lg border-gray-300 focus:ring-primary focus:border-primary" required>
                @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                <input type="email" name="email" value="{{ old('email') }}" class="w-full rounded-lg border-gray-300 focus:ring-primary focus:border-primary" required>
                @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Role (Peran)</label>
                <select name="role" class="w-full rounded-lg border-gray-300 focus:ring-primary focus:border-primary" required>
                    <option value="" disabled selected>-- Pilih Role --</option>
                    <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User (Brand/Umum)</option>
                    <option value="talent" {{ old('role') == 'talent' ? 'selected' : '' }}>Talent (Influencer)</option>
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Administrator</option>
                </select>
                @error('role') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input type="password" name="password" class="w-full rounded-lg border-gray-300 focus:ring-primary focus:border-primary" required>