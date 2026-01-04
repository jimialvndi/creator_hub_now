@extends('admin.layout')

@section('title', 'Buat Kelas Baru')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="mb-6 flex items-center justify-between">
        <h1 class="text-2xl font-bold text-gray-800">Buat Kelas Baru</h1>
        <a href="{{ route('admin.courses.index') }}" class="text-gray-500 hover:text-gray-700">← Kembali</a>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <form action="{{ route('admin.courses.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Judul Kelas</label>
                <input type="text" name="title" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary" placeholder="Contoh: Belajar Laravel 11 dari Nol" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Akses Level (Permission)</label>
                <select name="access_level" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary">
                    <option value="free">Free (Semua User Login)</option>
                    <option value="member">Member (Member & Pro)</option>
                    <option value="pro_member">Pro Member Only</option>
                </select>
                <p class="text-xs text-gray-500 mt-1">Tentukan siapa yang bisa menonton kelas ini.</p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Singkat</label>
                <textarea name="description" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary" required></textarea>
            </div>

            <div x-data="{ preview: null }">
                <label class="block text-sm font-medium text-gray-700 mb-1">Thumbnail Kelas</label>
                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg relative">
                    <div class="space-y-1 text-center" x-show="!preview">
                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <div class="flex text-sm text-gray-600 justify-center">
                            <label for="thumbnail" class="relative cursor-pointer bg-white rounded-md font-medium text-primary hover:text-blue-500">
                                <span>Upload a file</span>
                                <input id="thumbnail" name="thumbnail" type="file" class="sr-only" accept="image/*" @change="preview = URL.createObjectURL($event.target.files[0])" required>
                            </label>
                        </div>
                        <p class="text-xs text-gray-500">PNG, JPG up to 2MB</p>
                    </div>
                    <div x-show="preview" style="display: none;" class="absolute inset-0 w-full h-full">
                        <img :src="preview" class="w-full h-full object-cover rounded-lg">
                        <button type="button" @click="preview = null; document.getElementById('thumbnail').value = ''" class="absolute top-2 right-2 bg-red-500 text-white rounded-full p-1 shadow">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                    </div>
                </div>
            </div>

            <div class="pt-4">
                <button type="submit" class="w-full bg-primary text-white px-6 py-3 rounded-lg font-bold hover:bg-blue-700 transition">
                    Simpan & Lanjut Tambah Materi →
                </button>
            </div>
        </form>
    </div>
</div>
@endsection