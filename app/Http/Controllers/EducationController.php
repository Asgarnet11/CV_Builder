<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEducationRequest;
use App\Http\Requests\UpdateEducationRequest;
use App\Models\Education;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    public function index()
    {
        $education = auth()->user()->education()->orderBy('order_index')->orderByDesc('start_year')->get();

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

    /**
     * Reorder the education.
     */
    public function reorder(Request $request): JsonResponse
    {
        $request->validate([
            'orders' => ['required', 'array'],
            'orders.*.id' => ['required', 'integer', 'exists:education,id'],
            'orders.*.order_index' => ['required', 'integer'],
        ]);

        foreach ($request->orders as $order) {
            $education = Education::where('id', $order['id'])
                ->where('user_id', $request->user()->id)
                ->first();

            if ($education) {
                $education->update(['order_index' => $order['order_index']]);
            }
        }

        return response()->json(['message' => 'Urutan berhasil disimpan.']);
    }
}
