<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FastMove;
use Illuminate\Http\Request;

class FastMoveController extends Controller
{
    public function index()
    {
        $fastMoves = FastMove::orderBy('name')->paginate(20);
        return view('admin.fast-moves.index', compact('fastMoves'));
    }

    public function create()
    {
        return view('admin.fast-moves.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'name_en' => 'nullable|string|max:255',
            'type' => 'required|string|max:50',
            'power' => 'required|integer|min:0',
            'energy' => 'required|integer|min:0',
            'duration' => 'required|numeric|min:0',
            'dps' => 'nullable|numeric|min:0',
            'eps' => 'nullable|numeric|min:0',
            'is_legacy' => 'boolean',
            'description' => 'nullable|string',
        ]);

        $validated['is_legacy'] = $request->has('is_legacy');

        FastMove::create($validated);

        return redirect()->route('admin.fast-moves.index')
            ->with('success', 'Ataque rápido criado com sucesso!');
    }

    public function show(FastMove $fastMove)
    {
        return view('admin.fast-moves.show', compact('fastMove'));
    }

    public function edit(FastMove $fastMove)
    {
        return view('admin.fast-moves.edit', compact('fastMove'));
    }

    public function update(Request $request, FastMove $fastMove)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'name_en' => 'nullable|string|max:255',
            'type' => 'required|string|max:50',
            'power' => 'required|integer|min:0',
            'energy' => 'required|integer|min:0',
            'duration' => 'required|numeric|min:0',
            'dps' => 'nullable|numeric|min:0',
            'eps' => 'nullable|numeric|min:0',
            'is_legacy' => 'boolean',
            'description' => 'nullable|string',
        ]);

        $validated['is_legacy'] = $request->has('is_legacy');

        $fastMove->update($validated);

        return redirect()->route('admin.fast-moves.index')
            ->with('success', 'Ataque rápido atualizado com sucesso!');
    }

    public function destroy(FastMove $fastMove)
    {
        $fastMove->delete();

        return redirect()->route('admin.fast-moves.index')
            ->with('success', 'Ataque rápido removido com sucesso!');
    }
}
