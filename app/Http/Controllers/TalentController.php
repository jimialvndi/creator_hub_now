<?php

namespace App\Http\Controllers;

use App\Models\Talent;
use Illuminate\Http\Request;

class TalentController extends Controller
{
    public function index()
    {
        $talents = Talent::latest()->paginate(12);
        return view('talents.index', compact('talents'));
    }

    public function show(Talent $talent)
    {
        return view('talents.show', compact('talent'));
    }
}
