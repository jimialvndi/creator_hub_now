@extends('layouts.app')
@section('title', 'Buat Campaign - Step 1')
@section('content')
<div class="bg-gray-50 py-12">
    <div class="container mx-auto px-4 max-w-3xl">
        <div class="bg-white rounded-2xl shadow-xl p-8">
            <h2 class="text-3xl font-bold text-gray-900 mb-2">Mulai Campaign Anda</h2>
            <p class="text-gray-500 mb-8">Isi detail kebutuhan campaign untuk mendapatkan rekomendasi talent terbaik.</p>

            <form action="{{ route('campaigns.select') }}" method="POST">
                @csrf
                
                <h3 class="text-lg font-semibold text-primary mb-4 border-b pb-2">Informasi Pemesan</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Brand / Bisnis</label>
                        <input type="text" name="brand_name" required class="w-full rounded-lg border-gray-300 focus:ring-primary focus:border-primary">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">WhatsApp Aktif</label>
                        <input type="number" name="brand_whatsapp" required class="w-full rounded-lg border-gray-300 focus:ring-primary focus:border-primary">
                    </div>
                    <div class="col-span-full">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" name="brand_email" required class="w-full rounded-lg border-gray-300 focus:ring-primary focus:border-primary">
                    </div>
                </div>

                <h3 class="text-lg font-semibold text-primary mb-4 border-b pb-2">Detail Campaign</h3>
                <div class="space-y-4 mb-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Campaign</label>
                        <input type="text" name="campaign_name" placeholder="Contoh: Launching Menu Baru" required class="w-full rounded-lg border-gray-300 focus:ring-primary focus:border-primary">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Total Budget (Rp)</label>
                            <input type="number" name="budget" min="100000" placeholder="Min. 200.000" required class="w-full rounded-lg border-gray-300 focus:ring-primary focus:border-primary">
                            <p class="text-xs text-gray-500 mt-1">Sistem akan menghitung jumlah talent yang didapat.</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Niche Produk</label>
                            <select name="niche" class="w-full rounded-lg border-gray-300">
                                <option value="F&B">Food & Beverage</option>
                                <option value="Fashion">Fashion</option>
                                <option value="Beauty">Beauty</option>
                                <option value="Education">Education</option>
                                <option value="Technology">Technology</option>
                                <option value="Lifestyle">Lifestyle</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Platform Utama</label>
                        <div class="flex gap-4">
                            <label class="flex items-center gap-2 border p-3 rounded-lg cursor-pointer hover:bg-gray-50 w-full">
                                <input type="radio" name="platform" value="TikTok" checked class="text-primary focus:ring-primary">
                                <span>TikTok</span>
                            </label>
                            <label class="flex items-center gap-2 border p-3 rounded-lg cursor-pointer hover:bg-gray-50 w-full">
                                <input type="radio" name="platform" value="Instagram" class="text-primary focus:ring-primary">
                                <span>Instagram</span>
                            </label>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Brief Singkat (Opsional)</label>
                        <textarea name="brief" rows="3" class="w-full rounded-lg border-gray-300 focus:ring-primary focus:border-primary"></textarea>
                    </div>
                </div>

                <button type="submit" class="w-full bg-primary text-white font-bold py-4 rounded-xl hover:bg-blue-700 transition">
                    Lanjut Pilih Talent &rarr;
                </button>
            </form>
        </div>
    </div>
</div>
@endsection