<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Talent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminTalentController extends Controller
{
    public function index()
    {
        $talents = Talent::latest()->paginate(10);
        return view('admin.talents.index', compact('talents'));
    }

    public function create()
    {
        return view('admin.talents.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'niche' => 'required|string|max:255',
            'followers_count' => 'nullable|integer',
            'bio' => 'required|string',
            'skills' => 'required|string', // Input string dipisah koma
            'interests' => 'nullable|string',
            'experience' => 'nullable|string',
            'achievements' => 'nullable|string',
            'instagram' => 'nullable|url',
            'tiktok' => 'nullable|url',
            'youtube' => 'nullable|url',
            'linkedin' => 'nullable|url',
            'email' => 'nullable|email',
            'photo' => 'required|image|max:2048',
            'portfolio' => 'nullable|array', // Array dari form repeater
        ]);

        // Upload Foto Profil
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('talents', 'public');
        }

        // Convert String "Skill A, Skill B" menjadi Array JSON
        $data['skills'] = array_map('trim', explode(',', $request->skills));
        
        if($request->interests) {
            $data['interests'] = array_map('trim', explode(',', $request->interests));
        }

        // Handle Portfolio Uploads (JSON Structure)
        $portfolioData = [];
        if ($request->has('portfolio')) {
            foreach ($request->portfolio as $index => $item) {
                // Upload thumbnail jika ada
                $thumbPath = null;
                if (isset($item['thumbnail']) && $item['thumbnail'] instanceof \Illuminate\Http\UploadedFile) {
                    $thumbPath = $item['thumbnail']->store('portfolios', 'public');
                }

                $portfolioData[] = [
                    'title' => $item['title'] ?? 'Untitled Project',
                    'link'  => $item['link'] ?? '#',
                    'thumbnail' => $thumbPath
                ];
            }
        }
        $data['portfolio'] = $portfolioData; // Laravel otomatis encode ke JSON karena casting di Model

        Talent::create($data);

        return redirect()->route('admin.talents.index')->with('success', 'Talent added successfully!');
    }

    public function edit(Talent $talent)
    {
        return view('admin.talents.edit', compact('talent'));
    }

    public function update(Request $request, Talent $talent)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'niche' => 'required|string|max:255',
            'followers_count' => 'nullable|integer',
            'bio' => 'required|string',
            'skills' => 'required|string',
            'interests' => 'nullable|string',
            'experience' => 'nullable|string',
            'achievements' => 'nullable|string',
            'instagram' => 'nullable|url',
            'tiktok' => 'nullable|url',
            'youtube' => 'nullable|url',
            'linkedin' => 'nullable|url',
            'email' => 'nullable|email',
            'photo' => 'nullable|image|max:2048',
            'portfolio' => 'nullable|array',
        ]);

        // Handle Photo Update
        if ($request->hasFile('photo')) {
            // Hapus foto lama
            if ($talent->photo) Storage::disk('public')->delete($talent->photo);
            $data['photo'] = $request->file('photo')->store('talents', 'public');
        }

        // Convert Array
        $data['skills'] = array_map('trim', explode(',', $request->skills));
        if($request->interests) {
            $data['interests'] = array_map('trim', explode(',', $request->interests));
        }

        // Handle Portfolio Logic (Campuran data lama & baru agak kompleks, kita simplifikasi replace all untuk sekarang)
        // Idealnya: Cek apakah user upload gambar baru untuk portfolio tertentu.
        $currentPortfolio = $talent->portfolio ?? [];
        $newPortfolioData = [];

        if ($request->has('portfolio')) {
            foreach ($request->portfolio as $key => $item) {
                $thumbPath = $item['existing_thumbnail'] ?? null; // Ambil path lama dari hidden input

                if (isset($item['thumbnail']) && $item['thumbnail'] instanceof \Illuminate\Http\UploadedFile) {
                    $thumbPath = $item['thumbnail']->store('portfolios', 'public');
                }

                $newPortfolioData[] = [
                    'title' => $item['title'],
                    'link' => $item['link'],
                    'thumbnail' => $thumbPath
                ];
            }
        }
        $data['portfolio'] = $newPortfolioData;

        $talent->update($data);

        return redirect()->route('admin.talents.index')->with('success', 'Talent updated successfully!');
    }

    public function destroy(Talent $talent)
    {
        if ($talent->photo) Storage::disk('public')->delete($talent->photo);
        $talent->delete();
        return redirect()->route('admin.talents.index')->with('success', 'Talent deleted.');
    }
}