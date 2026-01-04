@extends('admin.layout')

@section('title', 'Edit Talent')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-bold text-gray-900">Edit Talent</h1>
    <p class="text-gray-600 mt-2">Update {{ $talent->name }}'s profile</p>
</div>

<div class="bg-white rounded-xl shadow-md p-8">
    <form action="{{ route('admin.talents.update', $talent) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Name -->
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Name *</label>
                <input type="text" name="name" value="{{ old('name', $talent->name) }}" class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-primary focus:outline-none @error('name') border-red-500 @enderror" required>
                @error('name')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <!-- Role -->
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Role *</label>
                <input type="text" name="role" value="{{ old('role', $talent->role) }}" class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-primary focus:outline-none @error('role') border-red-500 @enderror" required>
                @error('role')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>
        </div>

        <!-- Photo -->
        <div>
            <label class="block text-gray-700 font-semibold mb-2">Profile Photo</label>
            @if($talent->photo)
            <div class="mb-2">
                <img src="{{ Storage::url($talent->photo) }}" alt="{{ $talent->name }}" class="w-20 h-20 rounded-full object-cover">
            </div>
            @endif
            <input type="file" name="photo" accept="image/*" class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-primary focus:outline-none @error('photo') border-red-500 @enderror">
            @error('photo')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <!-- Tagline -->
        <div>
            <label class="block text-gray-700 font-semibold mb-2">Tagline *</label>
            <input type="text" name="tagline" value="{{ old('tagline', $talent->tagline) }}" class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-primary focus:outline-none @error('tagline') border-red-500 @enderror" required>
            @error('tagline')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <!-- Bio -->
        <div>
            <label class="block text-gray-700 font-semibold mb-2">Bio *</label>
            <textarea name="bio" rows="4" class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-primary focus:outline-none resize-none @error('bio') border-red-500 @enderror" required>{{ old('bio', $talent->bio) }}</textarea>
            @error('bio')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Niche -->
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Niche *</label>
                <input type="text" name="niche" value="{{ old('niche', $talent->niche) }}" class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-primary focus:outline-none @error('niche') border-red-500 @enderror" required>
                @error('niche')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <!-- Interests -->
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Interests</label>
                <input type="text" name="interests" value="{{ old('interests', is_array($talent->interests) ? implode(', ', $talent->interests) : '') }}" class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-primary focus:outline-none @error('interests') border-red-500 @enderror">
                @error('interests')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>
        </div>

        <!-- Skills -->
        <div>
            <label class="block text-gray-700 font-semibold mb-2">Skills * (comma separated)</label>
            <input type="text" name="skills" value="{{ old('skills', is_array($talent->skills) ? implode(', ', $talent->skills) : '') }}" class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-primary focus:outline-none @error('skills') border-red-500 @enderror" required>
            @error('skills')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <!-- Experience -->
        <div>
            <label class="block text-gray-700 font-semibold mb-2">Experience</label>
            <textarea name="experience" rows="3" class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-primary focus:outline-none resize-none @error('experience') border-red-500 @enderror">{{ old('experience', $talent->experience) }}</textarea>
            @error('experience')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <!-- Portfolio -->
        <div>
            <label class="block text-gray-700 font-semibold mb-2">Portfolio Items (comma separated)</label>
            <textarea name="portfolio" rows="3" class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-primary focus:outline-none resize-none @error('portfolio') border-red-500 @enderror">{{ old('portfolio', is_array($talent->portfolio) ? implode(', ', $talent->portfolio) : '') }}</textarea>
            @error('portfolio')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <!-- Achievements -->
        <div>
            <label class="block text-gray-700 font-semibold mb-2">Achievements</label>
            <textarea name="achievements" rows="3" class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-primary focus:outline-none resize-none @error('achievements') border-red-500 @enderror">{{ old('achievements', $talent->achievements) }}</textarea>
            @error('achievements')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <!-- Social Media -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Instagram URL</label>
                <input type="url" name="instagram" value="{{ old('instagram', $talent->instagram) }}" class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-primary focus:outline-none @error('instagram') border-red-500 @enderror">
                @error('instagram')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-gray-700 font-semibold mb-2">TikTok URL</label>
                <input type="url" name="tiktok" value="{{ old('tiktok', $talent->tiktok) }}" class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-primary focus:outline-none @error('tiktok') border-red-500 @enderror">
                @error('tiktok')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-gray-700 font-semibold mb-2">YouTube URL</label>
                <input type="url" name="youtube" value="{{ old('youtube', $talent->youtube) }}" class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-primary focus:outline-none @error('youtube') border-red-500 @enderror">
                @error('youtube')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-gray-700 font-semibold mb-2">LinkedIn URL</label>
                <input type="url" name="linkedin" value="{{ old('linkedin', $talent->linkedin) }}" class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-primary focus:outline-none @error('linkedin') border-red-500 @enderror">
                @error('linkedin')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>
        </div>

        <!-- Email -->
        <div>
            <label class="block text-gray-700 font-semibold mb-2">Email</label>
            <input type="email" name="email" value="{{ old('email', $talent->email) }}" class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-primary focus:outline-none @error('email') border-red-500 @enderror">
            @error('email')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <!-- Featured -->
        <div>
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $talent->is_featured) ? 'checked' : '' }} class="w-5 h-5 text-primary border-gray-300 rounded focus:ring-primary">
                <span class="text-gray-700 font-semibold">Mark as Featured</span>
            </label>
        </div>

        <!-- Submit -->
        <div class="flex gap-4">
            <button type="submit" class="bg-primary text-white px-8 py-3 rounded-lg font-bold hover:bg-blue-700 transition">
                Update Talent
            </button>
            <a href="{{ route('admin.talents.index') }}" class="bg-gray-300 text-gray-700 px-8 py-3 rounded-lg font-bold hover:bg-gray-400 transition">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
