<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlogPostController extends Controller
{
    public function index(Request $request)
    {
        $query = BlogPost::query();

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

        $posts = $query->latest()->paginate(10)->withQueryString();
        $totalPosts = BlogPost::count();
        $publishedPosts = BlogPost::where('is_published', true)->count();
        $draftPosts = BlogPost::where('is_published', false)->count();

        return view('admin_dashboard.blog_posts.index', compact(
            'posts',
            'totalPosts',
            'publishedPosts',
            'draftPosts'
        ));
    }

    public function create()
    {
        return view('admin_dashboard.blog_posts.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validatePost($request);
        $validated['slug'] = BlogPost::uniqueSlug($validated['title']);
        $validated['is_published'] = $request->boolean('is_published');
        $validated['published_at'] = $validated['is_published'] ? now() : null;
        $validated['user_id'] = $request->user()->id;

        if ($request->hasFile('feature_image')) {
            $validated['feature_image'] = $request->file('feature_image')->store('blog-posts', 'public');
        }

        $post = BlogPost::create($validated);

        return redirect()
            ->route('dashboard.blog-posts.index')
            ->with('success', "Blog post \"{$post->title}\" has been created successfully.");
    }

    public function show(BlogPost $blogPost)
    {
        return view('admin_dashboard.blog_posts.show', compact('blogPost'));
    }

    public function edit(BlogPost $blogPost)
    {
        return view('admin_dashboard.blog_posts.edit', compact('blogPost'));
    }

    public function update(Request $request, BlogPost $blogPost)
    {
        $validated = $this->validatePost($request);
        $validated['slug'] = BlogPost::uniqueSlug($validated['title'], $blogPost->id);
        $validated['is_published'] = $request->boolean('is_published');
        $validated['published_at'] = $validated['is_published']
            ? ($blogPost->published_at ?? now())
            : null;

        if ($request->hasFile('feature_image')) {
            if ($blogPost->feature_image) {
                Storage::disk('public')->delete($blogPost->feature_image);
            }

            $validated['feature_image'] = $request->file('feature_image')->store('blog-posts', 'public');
        }

        $blogPost->update($validated);

        return redirect()
            ->route('dashboard.blog-posts.index')
            ->with('success', "Blog post \"{$blogPost->title}\" has been updated successfully.");
    }

    public function destroy(BlogPost $blogPost)
    {
        $title = $blogPost->title;

        if ($blogPost->feature_image) {
            Storage::disk('public')->delete($blogPost->feature_image);
        }

        $blogPost->delete();

        return redirect()
            ->route('dashboard.blog-posts.index')
            ->with('success', "Blog post \"{$title}\" has been deleted successfully.");
    }

    private function validatePost(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'feature_image' => ['nullable', 'image', 'max:4096'],
            'description' => ['required', 'string'],
            'is_published' => ['sometimes', 'boolean'],
        ]);
    }
}
