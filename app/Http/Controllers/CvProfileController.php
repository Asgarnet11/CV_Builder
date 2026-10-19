<?php

namespace App\Http\Controllers;

use App\Http\Requests\CvProfileUpdateRequest;
use App\Models\CvProfile;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class CvProfileController extends Controller
{
    /**
     * Display the CV profile form.
     */
    public function edit(Request $request): View
    {
        $user = $request->user();
        $profile = $user->cvProfile;

        return view('cv-profile.edit', [
            'user' => $user,
            'profile' => $profile,
        ]);
    }

    /**
     * Update or create the user's CV profile.
     */
    public function update(CvProfileUpdateRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $user = $request->user();
        $existingProfile = CvProfile::where('user_id', $user->id)->first();

        if ($request->filled('photo_base64')) {
            $optimized = $this->processAndOptimizePhotoBase64($request->photo_base64);
            if ($optimized) {
                if ($existingProfile?->photo && Storage::disk('public')->exists($existingProfile->photo)) {
                    Storage::disk('public')->delete($existingProfile->photo);
                }

                $filename = 'photos/'.uniqid('photo_', true).'.'.$optimized['extension'];
                Storage::disk('public')->put($filename, $optimized['data']);
                $validated['photo'] = $filename;
            }
        } elseif ($request->hasFile('photo')) {
            if ($existingProfile?->photo && Storage::disk('public')->exists($existingProfile->photo)) {
                Storage::disk('public')->delete($existingProfile->photo);
            }

            $validated['photo'] = $request->file('photo')->store('photos', 'public');
        }

        unset($validated['photo_base64']);

        CvProfile::updateOrCreate(
            ['user_id' => $user->id],
            $validated
        );

        if ($request->wantsJson()) {
            return response()->json(['message' => 'Biodata CV berhasil disimpan otomatis.']);
        }

        return redirect()->route('cv-profile.edit')->with('status', 'Biodata CV berhasil disimpan!');
    }

    /**
     * Upload and update cropped photo via AJAX.
     */
    public function updatePhoto(Request $request): JsonResponse
    {
        $request->validate([
            'photo_base64' => ['required', 'string'],
        ]);

        try {
            $optimized = $this->processAndOptimizePhotoBase64($request->photo_base64);

            if (! $optimized) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Berkas foto tidak valid atau gagal diproses.',
                ], 422);
            }

            $user = $request->user();
            $profile = $user->cvProfile ?? $user->cvProfile()->create([
                'full_name' => $user->name,
            ]);

            $filename = 'photos/'.uniqid('photo_', true).'.'.$optimized['extension'];

            if ($profile->photo && Storage::disk('public')->exists($profile->photo)) {
                Storage::disk('public')->delete($profile->photo);
            }

            Storage::disk('public')->put($filename, $optimized['data']);

            $profile->update(['photo' => $filename]);

            return response()->json([
                'status' => 'success',
                'message' => 'Foto profil berhasil dipotong dan disimpan.',
                'photo_url' => asset('storage/'.$filename),
                'photo_path' => $filename,
                'width' => $optimized['width'],
                'height' => $optimized['height'],
                'size_kb' => round($optimized['size'] / 1024, 1),
            ]);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Delete the user's profile photo.
     */
    public function destroyPhoto(Request $request): JsonResponse
    {
        $user = $request->user();
        $profile = $user->cvProfile;

        if ($profile && $profile->photo) {
            if (Storage::disk('public')->exists($profile->photo)) {
                Storage::disk('public')->delete($profile->photo);
            }
            $profile->update(['photo' => null]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Foto profil berhasil dihapus.',
        ]);
    }

    /**
     * Decode base64 image and optimize size under 2MB while preserving native resolution.
     *
     * @return array{data: string, extension: string, width: int, height: int, size: int}|null
     */
    protected function processAndOptimizePhotoBase64(string $base64String, int $maxBytes = 2097152): ?array
    {
        if (preg_match('/^data:image\/(\w+);base64,/', $base64String, $matches)) {
            $imageType = strtolower($matches[1]);
            $base64Data = substr($base64String, strpos($base64String, ',') + 1);
        } else {
            $imageType = 'jpeg';
            $base64Data = $base64String;
        }

        if ($imageType === 'jpg') {
            $imageType = 'jpeg';
        }

        $binaryData = base64_decode($base64Data, true);
        if ($binaryData === false) {
            return null;
        }

        $imageInfo = @getimagesizefromstring($binaryData);
        if (! $imageInfo) {
            return null;
        }

        $width = (int) $imageInfo[0];
        $height = (int) $imageInfo[1];
        $size = strlen($binaryData);

        // If size is larger than maxBytes (2MB), compress using GD while preserving original width & height
        if ($size > $maxBytes && function_exists('imagecreatefromstring')) {
            $src = @imagecreatefromstring($binaryData);
            if ($src) {
                // Try compression at quality 88
                ob_start();
                imagejpeg($src, null, 88);
                $compressed = ob_get_clean();

                // If still above 2MB, try quality 78
                if (strlen($compressed) > $maxBytes) {
                    ob_start();
                    imagejpeg($src, null, 78);
                    $compressed = ob_get_clean();
                }

                if (strlen($compressed) <= $maxBytes) {
                    $binaryData = $compressed;
                    $size = strlen($binaryData);
                    $imageType = 'jpeg';
                }
                imagedestroy($src);
            }
        }

        $extension = match ($imageType) {
            'png' => 'png',
            'webp' => 'webp',
            default => 'jpg',
        };

        return [
            'data' => $binaryData,
            'extension' => $extension,
            'width' => $width,
            'height' => $height,
            'size' => $size,
        ];
    }
}
