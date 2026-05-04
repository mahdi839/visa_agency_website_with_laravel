<?php

namespace App\Http\Controllers;

use App\Models\Service;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::published()
            ->orderBy('sort_order')
            ->latest()
            ->get();

        if ($services->isEmpty()) {
            $services = Service::fallbackCollection();
        }

        return view('services', compact('services'));
    }
}
