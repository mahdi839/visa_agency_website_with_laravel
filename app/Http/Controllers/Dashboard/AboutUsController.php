<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    public function index(Request $request)
    {
        $query = AboutUs::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('subtitle', 'like', "%{$search}%")
                    ->orWhere('story_body', 'like', "%{$search}%")
                    ->orWhere('mission_body', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('is_published', $request->input('status') === 'published');
        }

        $aboutPages = $query->latest()->paginate(10)->withQueryString();
        $totalPages = AboutUs::count();
        $publishedPages = AboutUs::where('is_published', true)->count();
        $draftPages = AboutUs::where('is_published', false)->count();

        return view('admin_dashboard.about_us.index', compact(
            'aboutPages',
            'totalPages',
            'publishedPages',
            'draftPages'
        ));
    }

    public function create()
    {
        return view('admin_dashboard.about_us.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validateAbout($request);
        $validated['is_published'] = $request->boolean('is_published');

        $about = AboutUs::create($validated);

        return redirect()
            ->route('dashboard.about-us.index')
            ->with('success', "About page \"{$about->title}\" has been created successfully.");
    }

    public function show(AboutUs $aboutUs)
    {
        return view('admin_dashboard.about_us.show', compact('aboutUs'));
    }

    public function edit(AboutUs $aboutUs)
    {
        return view('admin_dashboard.about_us.edit', compact('aboutUs'));
    }

    public function update(Request $request, AboutUs $aboutUs)
    {
        $validated = $this->validateAbout($request);
        $validated['is_published'] = $request->boolean('is_published');

        $aboutUs->update($validated);

        return redirect()
            ->route('dashboard.about-us.index')
            ->with('success', "About page \"{$aboutUs->title}\" has been updated successfully.");
    }

    public function destroy(AboutUs $aboutUs)
    {
        $title = $aboutUs->title;
        $aboutUs->delete();

        return redirect()
            ->route('dashboard.about-us.index')
            ->with('success', "About page \"{$title}\" has been deleted successfully.");
    }

    private function validateAbout(Request $request): array
    {
        return $request->validate([
            'hero_label' => ['required', 'string', 'max:120'],
            'title' => ['required', 'string', 'max:255'],
            'subtitle' => ['nullable', 'string', 'max:1000'],
            'story_title' => ['required', 'string', 'max:255'],
            'story_body' => ['required', 'string'],
            'mission_title' => ['required', 'string', 'max:255'],
            'mission_body' => ['required', 'string'],
            'is_published' => ['sometimes', 'boolean'],
        ]);
    }
}
