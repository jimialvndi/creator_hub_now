@extends('admin.layout')

@section('title', 'Add New Talent')

@section('content')
<div class="mb-6 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Add New Talent</h1>
        <p class="text-sm text-gray-500">Create a new profile for the talent database.</p>
    </div>
    <a href="{{ route('admin.talents.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition shadow-sm">
        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Back to List
    </a>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="p-6 md:p-8">
        <form action="{{ route('admin.talents.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf

            <div class="space-y-6">
                <h3 class="text-lg font-bold text-gray-900 border-b pb-2 flex items-center gap-2">
                    <span class="bg-blue-100 text-primary w-6 h-6 flex items-center justify-center rounded-full text-xs">1</span>
                    Basic Information
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Full Name <span class="text-red-500">*</span></label>
                        <input type="text" name="name" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition" placeholder="e.g. John Doe" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Role / Profession <span class="text-red-500">*</span></label>
                        <input type="text" name="role" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition" placeholder="e.g. Content Creator" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Niche Category <span class="text-red-500">*</span></label>
                        <input type="text" name="niche" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition" placeholder="e.g. Technology, Food" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Total Followers</label>
                        <div class="relative">
                            <input type="number" name="followers_count" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition" placeholder="0">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-gray-400 text-xs">Users</div>
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Bio / Description <span class="text-red-500">*</span></label>
                    <textarea name="bio" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition" placeholder="Tell us about the talent..." required></textarea>
                </div>

                <div x-data="{ photoName: null, photoPreview: null }">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Profile Photo <span class="text-red-500">*</span></label>
                    
                    <input type="file" name="photo" id="photo" class="hidden" x-ref="photo" accept="image/*"
                        x-on:change="
                            photoName = $refs.photo.files[0].name;
                            const reader = new FileReader();
                            reader.onload = (e) => { photoPreview = e.target.result; };
                            reader.readAsDataURL($refs.photo.files[0]);
                        ">

                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:bg-gray-50 transition relative">
                        
                        <div class="space-y-1 text-center" x-show="!photoPreview">
                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <div class="flex text-sm text-gray-600 justify-center">
                                <label for="photo" class="relative cursor-pointer bg-white rounded-md font-medium text-primary hover:text-blue-500 focus-within:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                                    <span>Upload a file</span>
                                </label>
                                <p class="pl-1">or drag and drop</p>
                            </div>
                            <p class="text-xs text-gray-500">PNG, JPG, GIF up to 2MB</p>
                        </div>

                        <div class="text-center" x-show="photoPreview" style="display: none;">
                            <div class="relative inline-block">
                                <span class="block w-40 h-40 rounded-full bg-cover bg-no-repeat bg-center shadow-lg border-4 border-white"
                                      x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                                </span>
                                <div class="absolute bottom-2 right-2 bg-green-500 text-white p-1 rounded-full shadow-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                </div>
                            </div>
                            <div class="mt-3">
                                <p class="text-sm font-medium text-gray-900" x-text="photoName"></p>
                                <button type="button" class="text-xs text-red-600 hover:text-red-800 font-medium mt-1" x-on:click.prevent="$refs.photo.click()">
                                    Change Photo
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                <h3 class="text-lg font-bold text-gray-900 border-b pb-2 flex items-center gap-2">
                    <span class="bg-blue-100 text-primary w-6 h-6 flex items-center justify-center rounded-full text-xs">2</span>
                    Skills & Experience
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Skills (Comma separated) <span class="text-red-500">*</span></label>
                        <input type="text" name="skills" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition" placeholder="Editing, Writing, Public Speaking" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Interests</label>
                        <input type="text" name="interests" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition" placeholder="Gadget, Travel">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Experience</label>
                        <textarea name="experience" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition"></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Achievements</label>
                        <textarea name="achievements" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition"></textarea>
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                <h3 class="text-lg font-bold text-gray-900 border-b pb-2 flex items-center gap-2">
                    <span class="bg-blue-100 text-primary w-6 h-6 flex items-center justify-center rounded-full text-xs">3</span>
                    Portfolio Highlights
                </h3>
                <p class="text-sm text-gray-500">Tambahkan hingga 3 portfolio terbaik.</p>
                
                <div class="space-y-4">
                    @for ($i = 0; $i < 3; $i++)
                    <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                        <h4 class="font-bold text-xs uppercase text-gray-500 mb-3">Project {{ $i + 1 }}</h4>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <input type="text" name="portfolio[{{$i}}][title]" placeholder="Project Title" class="px-3 py-2 border border-gray-300 rounded-md text-sm">
                            <input type="url" name="portfolio[{{$i}}][link]" placeholder="Project URL" class="px-3 py-2 border border-gray-300 rounded-md text-sm">
                            <input type="file" name="portfolio[{{$i}}][thumbnail]" accept="image/*" class="text-xs text-gray-500 file:mr-2 file:py-1 file:px-2 file:rounded file:border-0 file:text-xs file:bg-blue-50 file:text-primary hover:file:bg-blue-100">
                        </div>
                    </div>
                    @endfor
                </div>
            </div>

            <div class="space-y-6">
                <h3 class="text-lg font-bold text-gray-900 border-b pb-2 flex items-center gap-2">
                    <span class="bg-blue-100 text-primary w-6 h-6 flex items-center justify-center rounded-full text-xs">4</span>
                    Social Media
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-500 font-bold text-xs">IG</span>
                        <input type="url" name="instagram" class="pl-10 w-full px-4 py-2 border border-gray-300 rounded-lg" placeholder="https://instagram.com/...">
                    </div>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-500 font-bold text-xs">TT</span>
                        <input type="url" name="tiktok" class="pl-10 w-full px-4 py-2 border border-gray-300 rounded-lg" placeholder="https://tiktok.com/...">
                    </div>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-500 font-bold text-xs">YT</span>
                        <input type="url" name="youtube" class="pl-10 w-full px-4 py-2 border border-gray-300 rounded-lg" placeholder="https://youtube.com/...">
                    </div>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-500 font-bold text-xs">IN</span>
                        <input type="url" name="linkedin" class="pl-10 w-full px-4 py-2 border border-gray-300 rounded-lg" placeholder="https://linkedin.com/in/...">
                    </div>
                     <div class="relative md:col-span-2">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-500 font-bold text-xs">@</span>
                        <input type="email" name="email" class="pl-10 w-full px-4 py-2 border border-gray-300 rounded-lg" placeholder="contact@email.com">
                    </div>
                </div>
            </div>

            <div class="pt-6 border-t border-gray-100 flex items-center gap-4">
                <button type="submit" class="bg-primary text-white px-6 py-2.5 rounded-lg font-bold hover:bg-blue-700 transition shadow-lg shadow-blue-500/30 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    Save Talent
                </button>
                <a href="{{ route('admin.talents.index') }}" class="text-gray-600 hover:text-gray-900 font-medium px-4 py-2 rounded-lg hover:bg-gray-100 transition">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection