<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        $query = Service::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('is_published', $request->input('status') === 'published');
        }

        $services = $query->orderBy('sort_order')->latest()->paginate(10)->withQueryString();
        $totalServices = Service::count();
        $publishedServices = Service::where('is_published', true)->count();
        $draftServices = Service::where('is_published', false)->count();

        return view('admin_dashboard.services.index', compact(
            'services',
            'totalServices',
            'publishedServices',
            'draftServices'
        ));
    }

    public function create()
    {
        return view('admin_dashboard.services.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validateService($request);
        $validated['slug'] = Service::uniqueSlug($validated['title']);
        $validated['sort_order'] = $validated['sort_order'] ?? 0;
        $validated['is_published'] = $request->boolean('is_published');

        $service = Service::create($validated);

        return redirect()
            ->route('dashboard.services.index')
            ->with('success', "Service \"{$service->title}\" has been created successfully.");
    }

    public function show(Service $service)
    {
        return view('admin_dashboard.services.show', compact('service'));
    }

    public function edit(Service $service)
    {
        return view('admin_dashboard.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $validated = $this->validateService($request);
        $validated['slug'] = Service::uniqueSlug($validated['title'], $service->id);
        $validated['sort_order'] = $validated['sort_order'] ?? 0;
        $validated['is_published'] = $request->boolean('is_published');

        $service->update($validated);

        return redirect()
            ->route('dashboard.services.index')
            ->with('success', "Service \"{$service->title}\" has been updated successfully.");
    }

    public function destroy(Service $service)
    {
        $title = $service->title;
        $service->delete();

        return redirect()
            ->route('dashboard.services.index')
            ->with('success', "Service \"{$title}\" has been deleted successfully.");
    }

    private function validateService(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'icon' => ['nullable', 'string', 'max:20'],
            'description' => ['required', 'string', 'max:2000'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_published' => ['sometimes', 'boolean'],
        ]);
    }
}
