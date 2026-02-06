@extends('admin.layout')

@section('title', 'Edit User')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-6 flex items-center justify-between">
        <h1 class="text-2xl font-bold text-gray-800">Edit User: {{ $user->name }}</h1>
        <a href="{{ route('admin.users.index') }}" class="text-gray-600 hover:text-gray-900 font-medium">
            &larr; Kembali
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 md:p-8">
        <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full rounded-lg border-gray-300 focus:ring-primary focus:border-primary" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full rounded-lg border-gray-300 focus:ring-primary focus:border-primary" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Role (Peran)</label>
                <select name="role" class="w-full rounded-lg border-gray-300 focus:ring-primary focus:border-primary" required>
                    <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User (Brand/Umum)</option>
                    <option value="talent" {{ $user->role == 'talent' ? 'selected' : '' }}>Talent (Influencer)</option>
                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Administrator</option>
                </select>
            </div>

            <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                <h3 class="font-bold text-gray-700 mb-2 text-sm">Ubah Password (Opsional)</h3>
                <p class="text-xs text-gray-500 mb-4">Kosongkan jika tidak ingin mengganti password.</p>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Password Baru</label>
                        <input type="password" name="password" class="w-full rounded-lg border-gray-300 focus:ring-primary focus:border-primary">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" class="w-full rounded-lg border-gray-300 focus:ring-primary focus:border-primary">
                    </div>
                </div>
            </div>

            <div class="pt-6 border-t flex justify-end">
                <button type="submit" class="bg-primary text-white font-bold py-2.5 px-6 rounded-lg hover:bg-blue-700 transition">
                    Update User
                </button>
            </div>
        </form>
    </div>
</div>
@endsection