<?php

namespace App\Http\Controllers;

use App\Models\Talent;
use App\Models\Campaign; // Pastikan Model Campaign sudah dibuat
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CampaignController extends Controller
{
    // STEP 1: Form Detail
    public function create()
    {
        return view('campaigns.create'); // Pastikan view ini ada
    }

    // STEP 2: Pilih Talent
    public function selectTalents(Request $request)
    {
        $validated = $request->validate([
            'brand_name' => 'required|string',
            'brand_email' => 'required|email',
            'brand_whatsapp' => 'required|numeric',
            'campaign_name' => 'required|string',
            'budget' => 'required|numeric|min:100000',
            'platform' => 'required|string',
            'niche' => 'required|string',
            'brief' => 'nullable|string',
        ]);

        session(['campaign_data' => $validated]);

        // Filter talent (contoh sederhana)
        $talents = Talent::where('niche', 'LIKE', '%' . $validated['niche'] . '%')->get();
        if($talents->isEmpty()) {
            $talents = Talent::latest()->limit(10)->get();
        }

        return view('campaigns.select-talents', compact('talents', 'validated'));
    }

    // STEP 3: Simpan Order
    public function store(Request $request)
    {
        $request->validate([
            'selected_talents' => 'required|array|min:1',
            'agreement_replacement' => 'required|accepted',
        ]);

        $campaignData = session('campaign_data');
        if (!$campaignData) return redirect()->route('campaigns.create');

        DB::transaction(function () use ($request, $campaignData) {
            $campaign = Campaign::create(array_merge($campaignData, [
                'agreement_replacement' => true,
                'status' => 'pending_payment',
            ]));

            $campaign->talents()->attach($request->selected_talents, ['status' => 'pending']);
            session()->forget('campaign_data');
        });

        // Redirect ke Homepage atau Halaman Sukses
        return redirect()->route('home')->with('success', 'Campaign request received! We will contact you shortly.');
    }
}