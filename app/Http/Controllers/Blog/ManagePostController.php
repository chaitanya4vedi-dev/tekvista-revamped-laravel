<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ManagePostController extends Controller
{
    public function index(): View
    {
        $posts = Post::query()
            ->with(['categories', 'tags'])
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('pages.blog.manage.index', [
            'title' => 'Tekvista | Manage Blog',
            'posts' => $posts,
        ]);
    }

    public function create(): View
    {
        return view('pages.blog.manage.create', [
            'title' => 'Tekvista | Write Blog',
            'categories' => Category::query()->orderBy('name')->get(),
            'tags' => Tag::query()->orderBy('name')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:180'],
            'excerpt' => ['required', 'string', 'max:320'],
            'content' => ['required', 'string', 'min:120'],
            'hero' => ['nullable', 'url', 'max:500'],
            'meta_title' => ['nullable', 'string', 'max:180'],
            'meta_description' => ['nullable', 'string', 'max:320'],
            'meta_keywords' => ['nullable', 'string', 'max:320'],
            'read_time' => ['nullable', 'string', 'max:40'],
            'published_on' => ['nullable', 'date'],
            'is_published' => ['nullable', 'boolean'],
            'categories_csv' => ['required', 'string', 'max:320'],
            'tags_csv' => ['nullable', 'string', 'max:320'],
        ]);

        $slugBase = Str::slug($validated['title']);
        $slug = $slugBase;
        $counter = 1;

        while (Post::query()->where('slug', $slug)->exists()) {
            $counter++;
            $slug = $slugBase . '-' . $counter;
        }

        $post = Post::create([
            'user_id' => Auth::id(),
            'title' => $validated['title'],
            'slug' => $slug,
            'excerpt' => $validated['excerpt'],
            'content' => $validated['content'],
            'hero' => $validated['hero'] ?? null,
            'meta_title' => $validated['meta_title'] ?? $validated['title'],
            'meta_description' => $validated['meta_description'] ?? $validated['excerpt'],
            'meta_keywords' => $validated['meta_keywords'] ?? null,
            'read_time' => $validated['read_time'] ?? '5 min read',
            'published_on' => $validated['published_on'] ?? now()->toDateString(),
            'is_published' => (bool) ($validated['is_published'] ?? true),
        ]);

        $categoryIds = collect(explode(',', $validated['categories_csv']))
            ->map(fn ($name) => trim((string) $name))
            ->filter()
            ->map(function (string $name): int {
            $category = Category::firstOrCreate(
                ['slug' => Str::slug($name)],
                ['name' => $name, 'description' => null]
            );

            return $category->id;
        })->all();

        $tagIds = collect(explode(',', (string) ($validated['tags_csv'] ?? '')))
            ->map(fn ($name) => trim((string) $name))
            ->filter()
            ->map(function (string $name): int {
            $tag = Tag::firstOrCreate(
                ['slug' => Str::slug($name)],
                ['name' => $name]
            );

            return $tag->id;
        })->all();

        $post->categories()->sync($categoryIds);
        $post->tags()->sync($tagIds);

        return redirect()->route('blog.manage.index')->with('status', 'Blog post published successfully.');
    }
}
