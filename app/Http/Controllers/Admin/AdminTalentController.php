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
        $talents = Talent::latest()->paginate(15);
        return view('admin.talents.index', compact('talents'));
    }

    public function create()
    {
        return view('admin.talents.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'role' => 'required|string|max:255',
            'tagline' => 'required|string',
            'bio' => 'required|string',
            'niche' => 'required|string|max:255',
            'interests' => 'nullable|string',
            'skills' => 'required|string',
            'experience' => 'nullable|string',
            'portfolio' => 'nullable|string',
            'achievements' => 'nullable|string',
            'instagram' => 'nullable|url',
            'tiktok' => 'nullable|url',
            'youtube' => 'nullable|url',
            'linkedin' => 'nullable|url',
            'email' => 'nullable|email',
            'is_featured' => 'boolean',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('talents', 'public');
        }

        // Convert comma-separated strings to JSON arrays
        $validated['skills'] = json_encode(array_map('trim', explode(',', $validated['skills'])));
        
        if (!empty($validated['interests'])) {
            $validated['interests'] = json_encode(array_map('trim', explode(',', $validated['interests'])));
        }
        
        if (!empty($validated['portfolio'])) {
            $validated['portfolio'] = json_encode(array_map('trim', explode(',', $validated['portfolio'])));
        }

        Talent::create($validated);

        return redirect()->route('admin.talents.index')->with('success', 'Talent added successfully!');
    }

    public function edit(Talent $talent)
    {
        return view('admin.talents.edit', compact('talent'));
    }

    public function update(Request $request, Talent $talent)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'role' => 'required|string|max:255',
            'tagline' => 'required|string',
            'bio' => 'required|string',
            'niche' => 'required|string|max:255',
            'interests' => 'nullable|string',
            'skills' => 'required|string',
            'experience' => 'nullable|string',
            'portfolio' => 'nullable|string',
            'achievements' => 'nullable|string',
            'instagram' => 'nullable|url',
            'tiktok' => 'nullable|url',
            'youtube' => 'nullable|url',
            'linkedin' => 'nullable|url',
            'email' => 'nullable|email',
            'is_featured' => 'boolean',
        ]);

        if ($request->hasFile('photo')) {
            if ($talent->photo) {
                Storage::disk('public')->delete($talent->photo);
            }
            $validated['photo'] = $request->file('photo')->store('talents', 'public');
        }

        // Convert comma-separated strings to JSON arrays
        $validated['skills'] = json_encode(array_map('trim', explode(',', $validated['skills'])));
        
        if (!empty($validated['interests'])) {
            $validated['interests'] = json_encode(array_map('trim', explode(',', $validated['interests'])));
        } else {
            $validated['interests'] = null;
        }
        
        if (!empty($validated['portfolio'])) {
            $validated['portfolio'] = json_encode(array_map('trim', explode(',', $validated['portfolio'])));
        } else {
            $validated['portfolio'] = null;
        }

        $talent->update($validated);

        return redirect()->route('admin.talents.index')->with('success', 'Talent updated successfully!');
    }

    public function destroy(Talent $talent)
    {
        if ($talent->photo) {
            Storage::disk('public')->delete($talent->photo);
        }
        
        $talent->delete();

        return redirect()->route('admin.talents.index')->with('success', 'Talent deleted successfully!');
    }
}
