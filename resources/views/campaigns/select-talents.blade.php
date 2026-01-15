@extends('layouts.app')
@section('title', 'Pilih Talent - Step 2')

@section('content')
<div class="bg-gray-50 py-12" x-data="talentSelector({{ $validated['budget'] }})">
    <div class="container mx-auto px-4">
        
        <div class="bg-white p-4 rounded-xl shadow-md mb-8 sticky top-4 z-40 border border-primary/20">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                <div>
                    <h2 class="text-xl font-bold text-gray-900">Pilih Talent</h2>
                    <p class="text-gray-500 text-sm">Budget: <span class="font-bold text-primary">Rp{{ number_format($validated['budget']) }}</span></p>
                </div>
                <div class="text-right">
                    <p class="text-sm text-gray-600">Terpilih: <span class="font-bold text-xl" x-text="selectedCount">0</span> Talent</p>
                    <p class="text-xs text-red-500" x-show="isOverBudget">Budget terlampaui!</p>
                </div>
            </div>
        </div>

        <form action="{{ route('campaigns.store') }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6 mb-12">
                @foreach($talents as $talent)
                <div class="bg-white rounded-xl shadow-sm overflow-hidden border-2 cursor-pointer transition-all relative"
                     :class="selectedIds.includes({{ $talent->id }}) ? 'border-primary ring-2 ring-primary ring-opacity-50' : 'border-transparent hover:border-gray-200'"
                     @click="toggleTalent({{ $talent->id }}, 150000)"> <div class="relative h-48 bg-gray-200">
                         @if($talent->photo)
                            <img src="{{ Storage::url($talent->photo) }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-primary flex items-center justify-center text-white text-3xl font-bold">{{ substr($talent->name, 0, 1) }}</div>
                        @endif
                        
                        <div class="absolute top-2 right-2" x-show="selectedIds.includes({{ $talent->id }})">
                            <div class="bg-primary text-white rounded-full p-1 shadow-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    
                    <div class="p-4">
                        <h3 class="font-bold text-gray-900">{{ $talent->name }}</h3>
                        <p class="text-xs text-gray-500">{{ $talent->niche }} • {{ $talent->followers_count }} Followers</p>
                    </div>

                    <input type="checkbox" name="selected_talents[]" value="{{ $talent->id }}" class="hidden" :checked="selectedIds.includes({{ $talent->id }})">
                </div>
                @endforeach
            </div>

            <div class="bg-white p-6 rounded-xl shadow-lg border-t-4 border-primary max-w-3xl mx-auto">
                <div class="flex items-start gap-3 mb-6">
                    <input type="checkbox" name="agreement_replacement" id="agreement" required class="mt-1 h-5 w-5 text-primary rounded border-gray-300 focus:ring-primary">
                    <label for="agreement" class="text-sm text-gray-700 leading-relaxed">
                        <span class="font-bold text-red-600 block mb-1">Persetujuan Wajib (Replacement Policy)</span>
                        Saya menyetujui bahwa apabila terdapat talent yang menolak campaign, platform berhak menggantinya dengan talent lain yang setara sesuai niche dan platform yang dipilih, tanpa mengubah total nilai campaign.
                    </label>
                </div>

                <button type="submit" 
                    :disabled="selectedCount === 0 || isOverBudget"
                    class="w-full bg-primary text-white font-bold py-4 rounded-xl hover:bg-blue-700 transition disabled:bg-gray-300 disabled:cursor-not-allowed">
                    Proses Pembayaran Campaign
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function talentSelector(totalBudget) {
        return {
            budget: totalBudget,
            selectedIds: [],
            // Asumsi harga per talent flat untuk campaign pool, misal 150rb (bisa dinamis dari DB nanti)
            costPerTalent: 150000, 
            
            get selectedCount() {
                return this.selectedIds.length;
            },
            
            get currentTotal() {
                return this.selectedIds.length * this.costPerTalent;
            },

            get isOverBudget() {
                return this.currentTotal > this.budget;
            },

            toggleTalent(id, price) {
                if (this.selectedIds.includes(id)) {
                    this.selectedIds = this.selectedIds.filter(i => i !== id);
                } else {
                    // Cek apakah cukup budget sebelum nambah
                    if ((this.currentTotal + this.costPerTalent) <= this.budget) {
                        this.selectedIds.push(id);
                    } else {
                        alert('Budget campaign Anda tidak mencukupi untuk menambah talent lagi.');
                    }
                }
            }
        }
    }
</script>
<script src="//unpkg.com/alpinejs" defer></script>
@endsection