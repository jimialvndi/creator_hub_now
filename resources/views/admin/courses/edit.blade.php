@extends('admin.layout')

@section('title', 'Edit Kelas & Materi')

@section('content')
<div class="max-w-5xl mx-auto">
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Edit Kelas: {{ $course->title }}</h1>
            <p class="text-sm text-gray-500">Kelola informasi kelas dan urutan materi video.</p>
        </div>
        <a href="{{ route('admin.courses.index') }}" class="text-gray-500 hover:text-gray-700">← Kembali ke List</a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h2 class="font-bold text-lg text-gray-800 mb-4 pb-2 border-b">Informasi Kelas</h2>
                
                <form action="{{ route('admin.courses.update', $course->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Judul Kelas</label>
                        <input type="text" name="title" value="{{ old('title', $course->title) }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary text-sm" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Akses Level</label>
                        <select name="access_level" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary text-sm">
                            <option value="free" {{ $course->access_level == 'free' ? 'selected' : '' }}>Free (Semua User)</option>
                            <option value="member" {{ $course->access_level == 'member' ? 'selected' : '' }}>Member (Member & Pro)</option>
                            <option value="pro_member" {{ $course->access_level == 'pro_member' ? 'selected' : '' }}>Pro Member Only</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                        <textarea name="description" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary text-sm" required>{{ old('description', $course->description) }}</textarea>
                    </div>

                    <div x-data="{ preview: '{{ $course->thumbnail ? asset('storage/' . $course->thumbnail) : '' }}' }">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Thumbnail</label>
                        
                        <div x-show="preview" class="mb-2 relative aspect-video rounded-lg overflow-hidden bg-gray-100">
                            <img :src="preview" class="w-full h-full object-cover">
                        </div>

                        <input type="file" name="thumbnail" @change="preview = URL.createObjectURL($event.target.files[0])" class="w-full text-xs text-gray-500 file:mr-2 file:py-1 file:px-2 file:rounded file:border-0 file:text-xs file:bg-blue-50 file:text-primary hover:file:bg-blue-100">
                        <p class="text-[10px] text-gray-400 mt-1">Biarkan kosong jika tidak ingin mengganti.</p>
                    </div>

                    <button type="submit" class="w-full bg-gray-800 text-white px-4 py-2 rounded-lg font-bold hover:bg-black transition text-sm">
                        Simpan Perubahan Info
                    </button>
                </form>
            </div>
        </div>

        <div class="lg:col-span-2 space-y-6">
            
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h2 class="font-bold text-lg text-gray-800 mb-4 pb-2 border-b flex items-center justify-between">
                    <span>Tambah Materi Baru</span>
                    <span class="text-xs font-normal text-gray-500 bg-gray-100 px-2 py-1 rounded">Video Youtube</span>
                </h2>

                <form action="{{ route('admin.courses.lessons.store', $course->id) }}" method="POST" class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end">
                    @csrf
                    
                    <div class="md:col-span-5">
                        <label class="block text-xs font-medium text-gray-700 mb-1">Judul Materi</label>
                        <input type="text" name="title" placeholder="Contoh: Pengenalan Dasar" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm" required>
                    </div>

                    <div class="md:col-span-4">
                        <label class="block text-xs font-medium text-gray-700 mb-1">Link Youtube</label>
                        <input type="url" name="youtube_url" placeholder="https://youtube.com/watch?v=..." class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm" required>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-xs font-medium text-gray-700 mb-1">Durasi</label>
                        <input type="text" name="duration" placeholder="10:00" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm" required>
                    </div>

                    <div class="md:col-span-1">
                        <button type="submit" class="w-full bg-primary text-white h-[38px] rounded-lg font-bold hover:bg-blue-700 transition flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        </button>
                    </div>
                </form>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-4 bg-gray-50 border-b border-gray-200 flex justify-between items-center">
                    <h3 class="font-bold text-gray-800">Daftar Materi ({{ $course->lessons->count() }})</h3>
                </div>
                
                <div class="divide-y divide-gray-100">
                    @forelse($course->lessons as $lesson)
                    <div class="p-4 flex items-center justify-between hover:bg-gray-50 transition group">
                        <div class="flex items-center gap-4">
                            <div class="w-8 h-8 rounded-full bg-blue-100 text-primary flex items-center justify-center font-bold text-xs">
                                {{ $loop->iteration }}
                            </div>
                            <div>
                                <h4 class="text-sm font-bold text-gray-900">{{ $lesson->title }}</h4>
                                <div class="flex items-center gap-3 text-xs text-gray-500">
                                    <span class="flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        {{ $lesson->duration }}
                                    </span>
                                    <a href="{{ $lesson->youtube_url }}" target="_blank" class="text-blue-500 hover:underline truncate max-w-[150px]">
                                        {{ $lesson->youtube_url }}
                                    </a>
                                </div>
                            </div>
                        </div>

                        <form action="{{ route('admin.lessons.destroy', $lesson->id) }}" method="POST" onsubmit="return confirm('Hapus materi ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-gray-400 hover:text-red-600 p-2 rounded-full hover:bg-red-50 transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </form>
                    </div>
                    @empty
                    <div class="p-8 text-center text-gray-500">
                        <p class="mb-2">Belum ada materi video di kelas ini.</p>
                        <p class="text-xs">Gunakan form di atas untuk menambahkan materi.</p>
                    </div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</div>
@endsection