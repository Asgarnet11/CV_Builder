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

        if ($request->hasFile('photo')) {
            if ($existingProfile?->photo) {
                Storage::disk('public')->delete($existingProfile->photo);
            }

            $validated['photo'] = $request->file('photo')->store('photos', 'public');
        }

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
            'photo_base64' => 'required|string',
        ]);

        $user = $request->user();
        $profile = $user->cvProfile ?? $user->cvProfile()->create(['full_name' => $user->name]);

        try {
            $image_parts = explode(';base64,', $request->photo_base64);
            $image_type_aux = explode('image/', $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);

            $filename = 'photos/'.uniqid().'.'.$image_type;

            if ($profile->photo && Storage::disk('public')->exists($profile->photo)) {
                Storage::disk('public')->delete($profile->photo);
            }

            Storage::disk('public')->put($filename, $image_base64);

            $profile->update(['photo' => $filename]);

            return response()->json([
                'status' => 'success',
                'photo_url' => asset('storage/'.$filename),
            ]);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }
}
