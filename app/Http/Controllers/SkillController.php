<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSkillRequest;
use App\Http\Requests\UpdateSkillRequest;
use App\Models\Skill;

class SkillController extends Controller
{
    public function index()
    {
        $skills = auth()->user()->skills()->orderBy('skill_name')->get();

        return view('skills.index', compact('skills'));
    }

    public function create()
    {
        return view('skills.create');
    }

    public function store(StoreSkillRequest $request)
    {
        auth()->user()->skills()->create($request->validated());

        return redirect()->route('skills.index')->with('status', 'Keahlian berhasil ditambahkan.');
    }

    public function edit(Skill $skill)
    {
        if ($skill->user_id !== auth()->id()) {
            abort(403);
        }

        return view('skills.edit', compact('skill'));
    }

    public function update(UpdateSkillRequest $request, Skill $skill)
    {
        if ($skill->user_id !== auth()->id()) {
            abort(403);
        }
        $skill->update($request->validated());

        return redirect()->route('skills.index')->with('status', 'Keahlian berhasil diperbarui.');
    }

    public function destroy(Skill $skill)
    {
        if ($skill->user_id !== auth()->id()) {
            abort(403);
        }
        $skill->delete();

        return redirect()->route('skills.index')->with('status', 'Keahlian berhasil dihapus.');
    }
}
