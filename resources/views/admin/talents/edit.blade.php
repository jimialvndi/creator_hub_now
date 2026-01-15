@extends('admin.layout')

@section('title', 'Edit Talent')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-6 flex items-center justify-between">
        <h1 class="text-2xl font-bold text-gray-800">Edit Talent: {{ $talent->name }}</h1>
        <a href="{{ route('admin.talents.index') }}" class="text-gray-600 hover:text-gray-900 font-medium">
            &larr; Back to List
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 md:p-8">
        <form action="{{ route('admin.talents.update', $talent->id) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf
            @method('PUT')

            <div class="space-y-6">
                <div class="flex justify-between items-center border-b pb-2">
                    <h3 class="text-lg font-bold text-gray-900">1. Basic Information</h3>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="is_featured" value="1" {{ $talent->is_featured ? 'checked' : '' }} class="rounded text-primary focus:ring-primary">
                        <span class="text-sm font-bold text-gray-700">Featured Talent</span>
                    </label>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                        <input type="text" name="name" value="{{ $talent->name }}" class="w-full rounded-lg border-gray-300" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Role</label>
                        <input type="text" name="role" value="{{ $talent->role }}" class="w-full rounded-lg border-gray-300" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Niche</label>
                        <select name="niche" class="w-full rounded-lg border-gray-300">
                            @foreach(['F&B', 'Beauty', 'Technology', 'Fashion', 'Lifestyle', 'Education'] as $niche)
                                <option value="{{ $niche }}" {{ $talent->niche == $niche ? 'selected' : '' }}>{{ $niche }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Followers</label>
                        <input type="number" name="followers_count" value="{{ $talent->followers_count }}" class="w-full rounded-lg border-gray-300">
                    </div>
                     <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Rate Min (Rp)</label>
                        <input type="number" name="rate_min" value="{{ $talent->rate_min }}" class="w-full rounded-lg border-gray-300" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Rate Max (Rp)</label>
                        <input type="number" name="rate_max" value="{{ $talent->rate_max }}" class="w-full rounded-lg border-gray-300" required>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Bio</label>
                    <textarea name="bio" rows="4" class="w-full rounded-lg border-gray-300" required>{{ $talent->bio }}</textarea>
                </div>

                <div class="flex gap-4 items-center">
                    @if($talent->photo)
                        <img src="{{ Storage::url($talent->photo) }}" class="w-16 h-16 rounded-full object-cover border">
                    @endif
                    <div class="flex-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Change Photo</label>
                        <input type="file" name="photo" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:bg-blue-50 file:text-primary hover:file:bg-blue-100">
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                <h3 class="text-lg font-bold text-gray-900 border-b pb-2">2. Skills & Details</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Skills</label>
                        <input type="text" name="skills" value="{{ is_array($talent->skills) ? implode(', ', $talent->skills) : $talent->skills }}" class="w-full rounded-lg border-gray-300" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Interests</label>
                        <input type="text" name="interests" value="{{ is_array($talent->interests) ? implode(', ', $talent->interests) : $talent->interests }}" class="w-full rounded-lg border-gray-300">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Experience</label>
                    <textarea name="experience" rows="3" class="w-full rounded-lg border-gray-300">{{ $talent->experience }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Achievements</label>
                    <textarea name="achievements" rows="3" class="w-full rounded-lg border-gray-300">{{ $talent->achievements }}</textarea>
                </div>
            </div>

            <div class="space-y-6" x-data="{ items: {{ json_encode($talent->portfolio ?? []) }} }">
                <div class="flex justify-between items-center border-b pb-2">
                    <h3 class="text-lg font-bold text-gray-900">3. Portfolio Highlights</h3>
                    <button type="button" @click="items.push({title: '', link: '', thumbnail: null})" class="text-sm bg-gray-100 text-primary px-3 py-1 rounded hover:bg-gray-200 font-bold">
                        + Add Item
                    </button>
                </div>

                <div class="space-y-4">
                    <template x-if="items.length === 0">
                        <div class="text-center py-4 text-gray-500 text-sm">Belum ada portfolio. Klik + Add Item.</div>
                    </template>

                    <template x-for="(item, index) in items" :key="index">
                        <div class="p-4 bg-gray-50 rounded-lg border border-gray-200 relative group">
                            <button type="button" @click="items = items.filter((_, i) => i !== index)" class="absolute top-2 right-2 text-red-400 hover:text-red-600 font-bold text-xl leading-none">
                                &times;
                            </button>
                            
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div>
                                    <label class="block text-xs font-bold text-gray-500 mb-1">Project Title</label>
                                    <input type="text" :name="`portfolio[${index}][title]`" x-model="item.title" class="w-full rounded-md border-gray-300 text-sm">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-gray-500 mb-1">Link URL</label>
                                    <input type="url" :name="`portfolio[${index}][link]`" x-model="item.link" class="w-full rounded-md border-gray-300 text-sm">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-gray-500 mb-1">Thumbnail</label>
                                    <input type="file" :name="`portfolio[${index}][thumbnail]`" accept="image/*" class="w-full text-xs text-gray-500 mb-1">
                                    
                                    <input type="hidden" :name="`portfolio[${index}][existing_thumbnail]`" x-model="item.thumbnail">

                                    <template x-if="item.thumbnail">
                                        <div class="text-xs text-green-600 flex items-center gap-1">
                                            <span>✓ Current:</span>
                                            <a :href="`/storage/${item.thumbnail}`" target="_blank" class="underline truncate max-w-[100px]">View Image</a>
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </div>

            <div class="space-y-6">
                <h3 class="text-lg font-bold text-gray-900 border-b pb-2">4. Social Media</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <input type="url" name="instagram" value="{{ $talent->instagram }}" placeholder="Instagram" class="w-full rounded-lg border-gray-300">
                    <input type="url" name="tiktok" value="{{ $talent->tiktok }}" placeholder="TikTok" class="w-full rounded-lg border-gray-300">
                    <input type="url" name="youtube" value="{{ $talent->youtube }}" placeholder="YouTube" class="w-full rounded-lg border-gray-300">
                    <input type="email" name="email" value="{{ $talent->email }}" placeholder="Email" class="w-full rounded-lg border-gray-300">
                </div>
            </div>

            <div class="pt-6 border-t flex gap-4">
                <button type="submit" class="bg-primary text-white font-bold py-3 px-8 rounded-xl hover:bg-blue-700 transition">
                    Update Profile
                </button>
            </div>
        </form>
    </div>
</div>
@endsection