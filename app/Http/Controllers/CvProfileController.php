<?php

namespace App\Http\Controllers;

use App\Http\Requests\CvProfileUpdateRequest;
use App\Models\CvProfile;
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
}
