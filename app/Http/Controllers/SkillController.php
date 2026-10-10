<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSkillRequest;
use App\Http\Requests\UpdateSkillRequest;
use App\Models\Skill;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function index()
    {
        $skills = auth()->user()->skills()->orderBy('order_index')->orderBy('skill_name')->get();

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

    /**
     * Reorder the skills.
     */
    public function reorder(Request $request): JsonResponse
    {
        $request->validate([
            'orders' => ['required', 'array'],
            'orders.*.id' => ['required', 'integer', 'exists:skills,id'],
            'orders.*.order_index' => ['required', 'integer'],
        ]);

        foreach ($request->orders as $order) {
            $skill = Skill::where('id', $order['id'])
                ->where('user_id', $request->user()->id)
                ->first();

            if ($skill) {
                $skill->update(['order_index' => $order['order_index']]);
            }
        }

        return response()->json(['message' => 'Urutan berhasil disimpan.']);
    }
}
