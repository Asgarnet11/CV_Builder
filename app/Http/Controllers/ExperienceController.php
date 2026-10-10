<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExperienceRequest;
use App\Http\Requests\UpdateExperienceRequest;
use App\Models\Experience;

class ExperienceController extends Controller
{
    public function index()
    {
        $experiences = auth()->user()->experiences()->orderByDesc('start_date')->get();

        return view('experience.index', compact('experiences'));
    }

    public function create()
    {
        return view('experience.create');
    }

    public function store(StoreExperienceRequest $request)
    {
        auth()->user()->experiences()->create($request->validated());

        return redirect()->route('experience.index')->with('status', 'Pengalaman berhasil ditambahkan.');
    }

    public function edit(Experience $experience)
    {
        if ($experience->user_id !== auth()->id()) {
            abort(403);
        }

        return view('experience.edit', compact('experience'));
    }

    public function update(UpdateExperienceRequest $request, Experience $experience)
    {
        if ($experience->user_id !== auth()->id()) {
            abort(403);
        }
        $experience->update($request->validated());

        return redirect()->route('experience.index')->with('status', 'Pengalaman berhasil diperbarui.');
    }

    public function destroy(Experience $experience)
    {
        if ($experience->user_id !== auth()->id()) {
            abort(403);
        }
        $experience->delete();

        return redirect()->route('experience.index')->with('status', 'Pengalaman berhasil dihapus.');
    }
}
