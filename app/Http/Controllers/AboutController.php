<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;

class AboutController extends Controller
{
    public function index()
    {
        $about = AboutUs::where('is_published', true)->latest()->first();

        return view('about', compact('about'));
    }
}
