<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::orderBy('sort_order')->latest()->paginate(12);

        return view('admin_dashboard.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        return view('admin_dashboard.testimonials.create');
    }

    public function store(Request $request)
    {
        Testimonial::create($this->validated($request));

        return redirect()->route('dashboard.testimonials.index')->with('success', 'Testimonial has been created.');
    }

    public function edit(Testimonial $testimonial)
    {
        return view('admin_dashboard.testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $testimonial->update($this->validated($request));

        return redirect()->route('dashboard.testimonials.index')->with('success', 'Testimonial has been updated.');
    }

    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();

        return redirect()->route('dashboard.testimonials.index')->with('success', 'Testimonial has been deleted.');
    }

    private function validated(Request $request): array
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'location' => ['nullable', 'string', 'max:255'],
            'visa_type' => ['nullable', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:5000'],
            'rating' => ['required', 'integer', Rule::in([1, 2, 3, 4, 5])],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_published' => ['sometimes', 'boolean'],
        ]);

        $validated['is_published'] = $request->boolean('is_published');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        return $validated;
    }
}
