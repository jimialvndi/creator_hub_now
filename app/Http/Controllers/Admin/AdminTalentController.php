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
        // 1. Validasi Input (Termasuk Rate Card & Featured)
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'niche' => 'required|string|max:255',
            'followers_count' => 'nullable|integer',
            'rate_min' => 'required|numeric|min:0', // BARU
            'rate_max' => 'required|numeric|gte:rate_min', // BARU
            'is_featured' => 'nullable', // Checkbox mengirim '1' atau null
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
            'photo' => 'required|image|max:2048',
            'portfolio' => 'nullable|array',
        ]);

        // Handle Checkbox Featured (jika dicentang value '1', jika tidak null -> convert ke boolean)
        $data['is_featured'] = $request->has('is_featured') ? true : false;

        // Upload Foto
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('talents', 'public');
        }

        // Convert String ke Array
        $data['skills'] = array_map('trim', explode(',', $request->skills));
        if($request->interests) {
            $data['interests'] = array_map('trim', explode(',', $request->interests));
        }

        // Handle Portfolio
        $portfolioData = [];
        if ($request->has('portfolio')) {
            foreach ($request->portfolio as $item) {
                $thumbPath = null;
                if (isset($item['thumbnail']) && $item['thumbnail'] instanceof \Illuminate\Http\UploadedFile) {
                    $thumbPath = $item['thumbnail']->store('portfolios', 'public');
                }
                $portfolioData[] = [
                    'title' => $item['title'] ?? 'Untitled',
                    'link'  => $item['link'] ?? '#',
                    'thumbnail' => $thumbPath
                ];
            }
        }
        $data['portfolio'] = $portfolioData;

        Talent::create($data);

        return redirect()->route('admin.talents.index')->with('success', 'Talent added successfully!');
    }

    public function edit(Talent $talent)
    {
        return view('admin.talents.edit', compact('talent'));
    }

    public function update(Request $request, Talent $talent)
    {
        // Validasi Update
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'niche' => 'required|string|max:255',
            'followers_count' => 'nullable|integer',
            'rate_min' => 'required|numeric|min:0', // BARU
            'rate_max' => 'required|numeric|gte:rate_min', // BARU
            'is_featured' => 'nullable',
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

        $data['is_featured'] = $request->has('is_featured') ? true : false;

        if ($request->hasFile('photo')) {
            if ($talent->photo) Storage::disk('public')->delete($talent->photo);
            $data['photo'] = $request->file('photo')->store('talents', 'public');
        }

        $data['skills'] = array_map('trim', explode(',', $request->skills));
        if($request->interests) {
            $data['interests'] = array_map('trim', explode(',', $request->interests));
        }

        // Simplifikasi Portfolio Update (Replace strategy for simplicity in example)
        $newPortfolioData = [];
        if ($request->has('portfolio')) {
            foreach ($request->portfolio as $item) {
                $thumbPath = $item['existing_thumbnail'] ?? null;
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