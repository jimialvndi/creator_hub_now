<?php

namespace App\Http\Controllers;

use App\Models\Talent;
use Illuminate\Http\Request;

class HomeController extends Controller
{
/*************  ✨ Windsurf Command ⭐  *************/
/**
 * Show the home page
 *
 * @return \Illuminate\Http\Response
 */
/*******  49afa796-15e1-4fc4-a212-279255bc6920  *******/    public function index()
    {
        $talents = Talent::latest()->take(6)->get();
        return view('home', compact('talents'));
    }

    public function about()
    {
        return view('about');
    }
}
