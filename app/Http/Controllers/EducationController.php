<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEducationRequest;
use App\Http\Requests\UpdateEducationRequest;
use App\Models\Education;

class EducationController extends Controller
{
    public function index()
    {
        $education = auth()->user()->education()->orderByDesc('start_year')->get();

        return view('education.index', compact('education'));
    }

    public function create()
    {
        return view('education.create');
    }

    public function store(StoreEducationRequest $request)
    {
        auth()->user()->education()->create($request->validated());

        return redirect()->route('education.index')->with('status', 'Pendidikan berhasil ditambahkan.');
    }

    public function edit(Education $education)
    {
        if ($education->user_id !== auth()->id()) {
            abort(403);
        }

        return view('education.edit', compact('education'));
    }

    public function update(UpdateEducationRequest $request, Education $education)
    {
        if ($education->user_id !== auth()->id()) {
            abort(403);
        }
        $education->update($request->validated());

        return redirect()->route('education.index')->with('status', 'Pendidikan berhasil diperbarui.');
    }

    public function destroy(Education $education)
    {
        if ($education->user_id !== auth()->id()) {
            abort(403);
        }
        $education->delete();

        return redirect()->route('education.index')->with('status', 'Pendidikan berhasil dihapus.');
    }
}
