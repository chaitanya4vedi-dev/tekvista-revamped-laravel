<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function edit(Request $request): View
    {
        return view('pages.profile.edit', [
            'title' => 'Tekvista | Profile Settings',
            'user' => $request->user(),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $user = $request->user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'username' => ['required', 'string', 'min:3', 'max:60', 'regex:/^[a-z0-9_\.]+$/i', Rule::unique('users', 'username')->ignore($user->id)],
            'email' => ['required', 'email:rfc', 'max:160', Rule::unique('users', 'email')->ignore($user->id)],
            'job_title' => ['nullable', 'string', 'max:120'],
            'department' => ['nullable', 'string', 'max:120'],
            'phone' => ['nullable', 'string', 'max:40'],
            'location' => ['nullable', 'string', 'max:160'],
            'timezone' => ['required', 'timezone:all'],
            'website_url' => ['nullable', 'url:http,https', 'max:255'],
            'linkedin_url' => ['nullable', 'url:http,https', 'max:255'],
            'avatar_url' => ['nullable', 'url:http,https', 'max:500'],
            'avatar_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'bio' => ['nullable', 'string', 'max:1500'],
            'password' => ['nullable', 'confirmed', 'min:8', 'max:120'],
        ]);

        if (empty($validated['password'])) {
            unset($validated['password']);
        }

        if ($request->hasFile('avatar_image')) {
            $uploaded = $request->file('avatar_image');
            $optimizedAvatar = $this->storeAuthorAvatar((string) $uploaded->getRealPath(), (string) $uploaded->getMimeType());
            if ($optimizedAvatar !== null) {
                $validated['avatar_url'] = $optimizedAvatar;
            }
        }

        unset($validated['avatar_image']);

        $user->fill($validated);
        $user->save();

        return redirect()->route('profile.edit')->with('status', 'Profile updated successfully.');
    }

    private function storeAuthorAvatar(string $path, string $mimeType = ''): ?string
    {
        if (!is_file($path)) {
            return null;
        }

        $mimeType = Str::lower($mimeType);
        $image = match ($mimeType) {
            'image/jpeg', 'image/jpg' => @imagecreatefromjpeg($path),
            'image/png' => @imagecreatefrompng($path),
            'image/webp' => function_exists('imagecreatefromwebp') ? @imagecreatefromwebp($path) : @imagecreatefromstring((string) file_get_contents($path)),
            default => @imagecreatefromstring((string) file_get_contents($path)),
        };

        if ($image === false) {
            return null;
        }

        $image = $this->applyExifOrientation($image, $path);

        $sourceWidth = imagesx($image);
        $sourceHeight = imagesy($image);
        $side = min($sourceWidth, $sourceHeight);
        $srcX = (int) floor(($sourceWidth - $side) / 2);
        $srcY = (int) floor(($sourceHeight - $side) / 2);

        $targetSize = 512;
        $canvas = imagecreatetruecolor($targetSize, $targetSize);
        imagecopyresampled($canvas, $image, 0, 0, $srcX, $srcY, $targetSize, $targetSize, $side, $side);

        $relativeDir = 'uploads/authors/' . now()->format('Y/m');
        $absoluteDir = public_path($relativeDir);
        File::ensureDirectoryExists($absoluteDir);

        $fileName = 'author-' . Str::random(10) . '.jpg';
        $absolutePath = $absoluteDir . '/' . $fileName;
        imagejpeg($canvas, $absolutePath, 88);

        imagedestroy($canvas);
        imagedestroy($image);

        return asset($relativeDir . '/' . $fileName);
    }

    private function applyExifOrientation(\GdImage $image, string $path): \GdImage
    {
        if (!function_exists('exif_read_data')) {
            return $image;
        }

        try {
            $exif = @exif_read_data($path);
            $orientation = (int) ($exif['Orientation'] ?? 1);
        } catch (\Throwable $e) {
            $orientation = 1;
        }

        return match ($orientation) {
            3 => imagerotate($image, 180, 0),
            6 => imagerotate($image, -90, 0),
            8 => imagerotate($image, 90, 0),
            default => $image,
        };
    }
}
