<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Talent;
use App\Models\Contact;
use App\Models\Campaign; // Pastikan import ini ada
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Hitung Statistik
        $talentsCount = Talent::count();
        $contactsCount = Contact::where('is_read', false)->count();
        
        // Cek dulu apakah tabel campaign sudah ada (biar aman dari error)
        $campaignCount = 0;
        $pendingCampaigns = 0;
        try {
             $campaignCount = Campaign::count();
             $pendingCampaigns = Campaign::where('status', 'pending_payment')->count();
        } catch (\Exception $e) {
             // Abaikan jika tabel belum ada
        }

        // Ambil data terbaru
        $recentTalents = Talent::latest()->take(5)->get();
        
        return view('admin.dashboard', compact(
            'talentsCount', 
            'contactsCount', 
            'campaignCount', 
            'pendingCampaigns',
            'recentTalents'
        ));
    }

    public function contacts()
    {
        $contacts = Contact::latest()->paginate(20);
        return view('admin.contacts', compact('contacts'));
    }

    public function markRead(Contact $contact)
    {
        $contact->update(['is_read' => true]);
        return redirect()->back()->with('success', 'Message marked as read.');
    }
}