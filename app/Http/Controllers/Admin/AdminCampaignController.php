<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\Talent;
use Illuminate\Http\Request;

class AdminCampaignController extends Controller
{
    public function index()
    {
        $campaigns = Campaign::latest()->paginate(10);
        return view('admin.campaigns.index', compact('campaigns'));
    }

    public function show(Campaign $campaign)
    {
        $campaign->load('talents');
        $allTalents = Talent::select('id', 'name', 'niche')->get(); // Untuk dropdown replacement
        return view('admin.campaigns.show', compact('campaign', 'allTalents'));
    }

    public function update(Request $request, Campaign $campaign)
    {
        // Update status global campaign (misal: sudah bayar)
        $request->validate(['status' => 'required']);
        $campaign->update(['status' => $request->status]);
        return back()->with('success', 'Campaign status updated.');
    }

    public function updateTalentStatus(Request $request, Campaign $campaign, Talent $talent)
    {
        // Update status per talent (Accept/Reject)
        $request->validate(['status' => 'required']);
        $campaign->talents()->updateExistingPivot($talent->id, [
            'status' => $request->status
        ]);
        return back()->with('success', 'Talent status updated.');
    }

    public function addTalent(Request $request, Campaign $campaign)
    {
        // Fitur Replacement Policy
        $request->validate(['talent_id' => 'required|exists:talents,id']);
        
        if (!$campaign->talents()->where('talent_id', $request->talent_id)->exists()) {
            $campaign->talents()->attach($request->talent_id, ['status' => 'pending']);
        }
        
        return back()->with('success', 'Replacement talent added.');
    }
}