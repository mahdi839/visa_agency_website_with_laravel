<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\Service;
use App\Models\Testimonial;

class HomeController extends Controller
{
    public function index()
    {
        $latestPosts = BlogPost::published()
            ->latest('published_at')
            ->latest()
            ->take(3)
            ->get();

        $services = Service::published()
            ->orderBy('sort_order')
            ->latest()
            ->take(6)
            ->get();

        if ($services->isEmpty()) {
            $services = Service::fallbackCollection();
        }

        $testimonials = Testimonial::published()
            ->orderBy('sort_order')
            ->latest()
            ->take(3)
            ->get();

        return view('home', compact('latestPosts', 'services', 'testimonials'));
    }
}
