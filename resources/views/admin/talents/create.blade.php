@extends('admin.layout')

@section('title', 'Add New Talent')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-6 flex items-center justify-between">
        <h1 class="text-2xl font-bold text-gray-800">Add New Talent</h1>
        <a href="{{ route('admin.talents.index') }}" class="text-gray-600 hover:text-gray-900 font-medium">
            &larr; Back to List
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 md:p-8">
        <form action="{{ route('admin.talents.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf

            <div class="space-y-6">
                <h3 class="text-lg font-bold text-gray-900 border-b pb-2">1. Basic Information</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Full Name *</label>
                        <input type="text" name="name" class="w-full rounded-lg border-gray-300 focus:ring-primary focus:border-primary" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Role / Profession *</label>
                        <input type="text" name="role" placeholder="e.g. Food Vlogger" class="w-full rounded-lg border-gray-300 focus:ring-primary focus:border-primary" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Niche Category *</label>
                        <select name="niche" class="w-full rounded-lg border-gray-300 focus:ring-primary focus:border-primary">
                            <option value="F&B">F&B (Kuliner)</option>
                            <option value="Beauty">Beauty</option>
                            <option value="Technology">Technology</option>
                            <option value="Fashion">Fashion</option>
                            <option value="Lifestyle">Lifestyle</option>
                            <option value="Education">Education</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Total Followers</label>
                        <input type="number" name="followers_count" placeholder="0" class="w-full rounded-lg border-gray-300 focus:ring-primary focus:border-primary">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Rate Min (Rp) *</label>
                        <input type="number" name="rate_min" placeholder="100000" class="w-full rounded-lg border-gray-300 focus:ring-primary focus:border-primary" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Rate Max (Rp) *</label>
                        <input type="number" name="rate_max" placeholder="500000" class="w-full rounded-lg border-gray-300 focus:ring-primary focus:border-primary" required>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Bio / Description *</label>
                    <textarea name="bio" rows="4" class="w-full rounded-lg border-gray-300 focus:ring-primary focus:border-primary" required></textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Profile Photo *</label>
                    <input type="file" name="photo" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-primary hover:file:bg-blue-100" required>
                </div>
            </div>

            <div class="space-y-6">
                <h3 class="text-lg font-bold text-gray-900 border-b pb-2">2. Skills & Details</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Skills (Pisahkan koma) *</label>
                        <input type="text" name="skills" placeholder="Editing, Speaking, Coding" class="w-full rounded-lg border-gray-300 focus:ring-primary focus:border-primary" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Interests</label>
                        <input type="text" name="interests" placeholder="Travel, Music" class="w-full rounded-lg border-gray-300 focus:ring-primary focus:border-primary">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Experience</label>
                    <textarea name="experience" rows="3" class="w-full rounded-lg border-gray-300 focus:ring-primary focus:border-primary"></textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Achievements</label>
                    <textarea name="achievements" rows="3" class="w-full rounded-lg border-gray-300 focus:ring-primary focus:border-primary"></textarea>
                </div>
            </div>

            <div class="space-y-6" x-data="{ items: [{title: '', link: ''}] }">
                <div class="flex justify-between items-center border-b pb-2">
                    <h3 class="text-lg font-bold text-gray-900">3. Portfolio Highlights</h3>
                    <button type="button" @click="items.push({title: '', link: ''})" class="text-sm bg-gray-100 text-primary px-3 py-1 rounded hover:bg-gray-200 font-bold">
                        + Add Item
                    </button>
                </div>

                <div class="space-y-4">
                    <template x-for="(item, index) in items" :key="index">
                        <div class="p-4 bg-gray-50 rounded-lg border border-gray-200 relative group">
                            <button type="button" @click="items = items.filter((_, i) => i !== index)" class="absolute top-2 right-2 text-red-400 hover:text-red-600">
                                &times; Remove
                            </button>
                            
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div>
                                    <label class="block text-xs font-bold text-gray-500 mb-1">Project Title</label>
                                    <input type="text" :name="`portfolio[${index}][title]`" class="w-full rounded-md border-gray-300 text-sm" placeholder="Project Name" required>
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-gray-500 mb-1">Link URL</label>
                                    <input type="url" :name="`portfolio[${index}][link]`" class="w-full rounded-md border-gray-300 text-sm" placeholder="https://...">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-gray-500 mb-1">Thumbnail Image</label>
                                    <input type="file" :name="`portfolio[${index}][thumbnail]`" accept="image/*" class="w-full text-xs text-gray-500">
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
                <p class="text-xs text-gray-500 italic">* Klik "+ Add Item" untuk menambah portfolio baru.</p>
            </div>

            <div class="space-y-6">
                <h3 class="text-lg font-bold text-gray-900 border-b pb-2">4. Social Media</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <input type="url" name="instagram" placeholder="Instagram URL" class="w-full rounded-lg border-gray-300">
                    <input type="url" name="tiktok" placeholder="TikTok URL" class="w-full rounded-lg border-gray-300">
                    <input type="url" name="youtube" placeholder="YouTube URL" class="w-full rounded-lg border-gray-300">
                    <input type="email" name="email" placeholder="Contact Email" class="w-full rounded-lg border-gray-300">
                </div>
            </div>

            <div class="pt-6 border-t">
                <button type="submit" class="w-full bg-primary text-white font-bold py-3 rounded-xl hover:bg-blue-700 transition">
                    Save New Talent
                </button>
            </div>
        </form>
    </div>
</div>
@endsection