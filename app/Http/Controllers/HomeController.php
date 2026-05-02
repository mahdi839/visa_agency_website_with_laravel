<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // When you have a Blog model, replace this with:
        // $latestPosts = \App\Models\Post::latest()->take(3)->get();
        // return view('home', compact('latestPosts'));

        return view('home');
    }
}