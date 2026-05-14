<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ManagePostController extends Controller
{
    private const PUBLISH_TZ = 'Asia/Kolkata';

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
        return view('pages.blog.manage.form', [
            'title' => 'Tekvista | Write Blog',
            'mode' => 'create',
            'post' => null,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validatePostRequest($request);
        $post = new Post(['user_id' => Auth::id()]);
        $this->savePost($post, $request, $validated);

        return redirect()->route('blog.manage.index')->with('status', 'Blog post saved successfully.');
    }

    public function edit(int $postId): View
    {
        $post = Post::query()
            ->with(['categories', 'tags'])
            ->where('user_id', Auth::id())
            ->findOrFail($postId);

        return view('pages.blog.manage.form', [
            'title' => 'Tekvista | Edit Blog',
            'mode' => 'edit',
            'post' => $post,
        ]);
    }

    public function update(Request $request, int $postId): RedirectResponse
    {
        $post = Post::query()
            ->where('user_id', Auth::id())
            ->findOrFail($postId);

        $validated = $this->validatePostRequest($request, $post);
        $this->savePost($post, $request, $validated);

        return redirect()->route('blog.manage.index')->with('status', 'Blog post updated successfully.');
    }

    private function validatePostRequest(Request $request, ?Post $post = null): array
    {
        $slugRule = ['nullable', 'string', 'max:190', 'regex:/^[a-z0-9-]+$/'];
        $slugUnique = Rule::unique('posts', 'slug');
        if ($post !== null) {
            $slugUnique = $slugUnique->ignore($post->id);
        }
        $slugRule[] = $slugUnique;

        return $request->validate([
            'title' => ['required', 'string', 'max:180'],
            'slug' => $slugRule,
            'excerpt' => ['nullable', 'string', 'max:320'],
            'content' => ['required', 'string', 'min:40'],
            'hero' => ['nullable', 'url:http,https', 'max:500'],
            'hero_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:8192'],
            'meta_title' => ['nullable', 'string', 'max:180'],
            'meta_description' => ['nullable', 'string', 'max:320'],
            'meta_keywords' => ['nullable', 'string', 'max:320'],
            'read_time' => ['nullable', 'string', 'max:40'],
            'publish_mode' => ['required', Rule::in(['draft', 'publish', 'schedule'])],
            'publish_at' => ['nullable', 'date_format:Y-m-d\TH:i'],
            'categories_csv' => ['nullable', 'string', 'max:320'],
            'tags_csv' => ['nullable', 'string', 'max:320'],
        ]);
    }

    private function savePost(Post $post, Request $request, array $validated): void
    {
        $slug = $this->generateUniqueSlug($validated['title'], $validated['slug'] ?? null, $post->id ?: null);
        $plainContent = $this->plainText($validated['content']);
        $excerpt = $this->smartExcerpt($validated['excerpt'] ?? '', $plainContent, $validated['title']);
        $hero = $this->resolveHeroImage($request, (string) ($validated['hero'] ?? ''), $post->hero);
        [$isPublished, $publishedAtUtc] = $this->resolvePublishingState((string) $validated['publish_mode'], (string) ($validated['publish_at'] ?? ''));

        $post->fill([
            'title' => $validated['title'],
            'slug' => $slug,
            'excerpt' => $excerpt,
            'content' => $validated['content'],
            'hero' => $hero,
            'meta_title' => $this->smartMetaTitle((string) ($validated['meta_title'] ?? ''), $validated['title']),
            'meta_description' => $this->smartMetaDescription((string) ($validated['meta_description'] ?? ''), $excerpt, $plainContent),
            'meta_keywords' => $this->smartMetaKeywords((string) ($validated['meta_keywords'] ?? ''), $validated['title'], (string) ($validated['categories_csv'] ?? ''), (string) ($validated['tags_csv'] ?? '')),
            'read_time' => !empty($validated['read_time']) ? (string) $validated['read_time'] : $this->estimateReadTime($plainContent),
            'published_at' => $publishedAtUtc,
            'published_on' => $publishedAtUtc?->clone()->timezone(self::PUBLISH_TZ)->toDateString(),
            'is_published' => $isPublished,
        ]);

        $post->save();

        $categoryNames = collect(explode(',', (string) ($validated['categories_csv'] ?? '')))
            ->map(fn ($name) => trim((string) $name))
            ->filter();

        if ($categoryNames->isEmpty()) {
            $categoryNames = collect(['General']);
        }

        $categoryIds = $categoryNames
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
    }

    private function resolvePublishingState(string $mode, string $publishAtInput): array
    {
        if ($mode === 'draft') {
            return [false, null];
        }

        if ($mode === 'schedule') {
            $publishAtIst = $publishAtInput !== ''
                ? Carbon::createFromFormat('Y-m-d\TH:i', $publishAtInput, self::PUBLISH_TZ)
                : Carbon::now(self::PUBLISH_TZ)->addHour();

            return [true, $publishAtIst->clone()->utc()];
        }

        return [true, Carbon::now(self::PUBLISH_TZ)->utc()];
    }

    private function generateUniqueSlug(string $title, ?string $providedSlug = null, ?int $ignoreId = null): string
    {
        $base = Str::slug($providedSlug ?: $title);
        if ($base === '') {
            $base = 'post';
        }

        $slug = $base;
        $counter = 1;
        while (Post::query()->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))->where('slug', $slug)->exists()) {
            $counter++;
            $slug = $base . '-' . $counter;
        }

        return $slug;
    }

    private function plainText(string $content): string
    {
        return trim((string) preg_replace('/\s+/', ' ', strip_tags($content)));
    }

    private function smartExcerpt(string $provided, string $plainContent, string $title): string
    {
        $candidate = trim($provided);
        if ($candidate === '') {
            $source = $plainContent !== '' ? $plainContent : $title;
            $candidate = Str::limit($source, 300, '...');
        }

        return Str::limit($candidate, 320, '...');
    }

    private function smartMetaTitle(string $provided, string $title): string
    {
        $candidate = trim($provided) !== '' ? trim($provided) : $title . ' | TekVista Enterprise Insights';
        return Str::limit($candidate, 180, '');
    }

    private function smartMetaDescription(string $provided, string $excerpt, string $plainContent): string
    {
        $candidate = trim($provided);
        if ($candidate === '') {
            $seed = $excerpt !== '' ? $excerpt : $plainContent;
            $candidate = Str::limit($seed, 300, '...');
        }

        return Str::limit($candidate, 320, '...');
    }

    private function smartMetaKeywords(string $provided, string $title, string $categoriesCsv, string $tagsCsv): string
    {
        $candidate = trim($provided);
        if ($candidate !== '') {
            return Str::limit($candidate, 320, '');
        }

        $tokens = collect([$title, $categoriesCsv, $tagsCsv, 'enterprise IT', 'cloud', 'cybersecurity', 'networking'])
            ->flatMap(fn (string $chunk) => preg_split('/[,|]/', $chunk) ?: [])
            ->map(fn (string $part) => trim($part))
            ->filter()
            ->unique(fn (string $part) => Str::lower($part))
            ->values()
            ->take(14)
            ->implode(', ');

        return Str::limit($tokens, 320, '');
    }

    private function estimateReadTime(string $plainContent): string
    {
        $wordCount = str_word_count($plainContent);
        $minutes = max(1, (int) ceil($wordCount / 210));
        return $minutes . ' min read';
    }

    private function resolveHeroImage(Request $request, string $heroUrl, ?string $existingHero = null): ?string
    {
        if ($request->hasFile('hero_image')) {
            $bytes = file_get_contents($request->file('hero_image')->getRealPath());
            if ($bytes !== false) {
                return $this->storeOptimizedImage($bytes, 'blog', 'hero', 1200, 630, 86);
            }
        }

        $heroUrl = trim($heroUrl);
        if ($heroUrl === '') {
            return $existingHero;
        }

        try {
            $response = Http::timeout(12)->get($heroUrl);
            $contentType = Str::lower((string) $response->header('Content-Type'));

            if ($response->ok() && Str::startsWith($contentType, 'image/')) {
                return $this->storeOptimizedImage($response->body(), 'blog', 'hero', 1200, 630, 86);
            }
        } catch (\Throwable $e) {
        }

        return $heroUrl;
    }

    private function storeOptimizedImage(string $binary, string $folder, string $prefix, int $targetWidth, int $targetHeight, int $quality): ?string
    {
        $image = @imagecreatefromstring($binary);
        if ($image === false) {
            return null;
        }

        $sourceWidth = imagesx($image);
        $sourceHeight = imagesy($image);
        $sourceRatio = $sourceWidth / max(1, $sourceHeight);
        $targetRatio = $targetWidth / $targetHeight;

        if ($sourceRatio > $targetRatio) {
            $cropHeight = $sourceHeight;
            $cropWidth = (int) round($sourceHeight * $targetRatio);
            $srcX = (int) floor(($sourceWidth - $cropWidth) / 2);
            $srcY = 0;
        } else {
            $cropWidth = $sourceWidth;
            $cropHeight = (int) round($sourceWidth / $targetRatio);
            $srcX = 0;
            $srcY = (int) floor(($sourceHeight - $cropHeight) / 2);
        }

        $canvas = imagecreatetruecolor($targetWidth, $targetHeight);
        imagecopyresampled($canvas, $image, 0, 0, $srcX, $srcY, $targetWidth, $targetHeight, $cropWidth, $cropHeight);

        $relativeDir = 'uploads/' . $folder . '/' . now()->format('Y/m');
        $absoluteDir = public_path($relativeDir);
        File::ensureDirectoryExists($absoluteDir);

        $fileName = $prefix . '-' . Str::random(10) . '.jpg';
        $absolutePath = $absoluteDir . '/' . $fileName;
        imagejpeg($canvas, $absolutePath, $quality);

        imagedestroy($canvas);
        imagedestroy($image);

        return asset($relativeDir . '/' . $fileName);
    }
}
