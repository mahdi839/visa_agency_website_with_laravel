<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Models\VisaApplication;
use Illuminate\Http\Request;

class VisaApplicationController extends Controller
{
    public function index(Request $request)
    {
        $applications = $request->user()
            ->visaApplications()
            ->latest()
            ->paginate(10);

        return view('portal.index', compact('applications'));
    }

    public function show(Request $request, VisaApplication $visaApplication)
    {
        abort_unless($visaApplication->user_id === $request->user()->id, 403);

        return view('portal.application', compact('visaApplication'));
    }
}
