<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChargeMove;
use Illuminate\Http\Request;

class ChargeMoveController extends Controller
{
    public function index()
    {
        $chargeMoves = ChargeMove::orderBy('name')->paginate(20);
        return view('admin.charge-moves.index', compact('chargeMoves'));
    }

    public function create()
    {
        return view('admin.charge-moves.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'name_en' => 'nullable|string|max:255',
            'type' => 'required|string|max:50',
            'power' => 'required|integer|min:0',
            'energy_cost' => 'required|integer|min:0',
            'bars' => 'required|integer|min:1|max:3',
            'dpe' => 'nullable|numeric|min:0',
            'has_debuff' => 'boolean',
            'debuff_chance' => 'nullable|numeric|min:0|max:1',
            'debuff_type' => 'nullable|string|max:50',
            'debuff_stages' => 'nullable|integer',
            'is_legacy' => 'boolean',
            'description' => 'nullable|string',
        ]);

        $validated['has_debuff'] = $request->has('has_debuff');
        $validated['is_legacy'] = $request->has('is_legacy');

        ChargeMove::create($validated);

        return redirect()->route('admin.charge-moves.index')
            ->with('success', 'Ataque carregado criado com sucesso!');
    }

    public function show(ChargeMove $chargeMove)
    {
        return view('admin.charge-moves.show', compact('chargeMove'));
    }

    public function edit(ChargeMove $chargeMove)
    {
        return view('admin.charge-moves.edit', compact('chargeMove'));
    }

    public function update(Request $request, ChargeMove $chargeMove)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'name_en' => 'nullable|string|max:255',
            'type' => 'required|string|max:50',
            'power' => 'required|integer|min:0',
            'energy_cost' => 'required|integer|min:0',
            'bars' => 'required|integer|min:1|max:3',
            'dpe' => 'nullable|numeric|min:0',
            'has_debuff' => 'boolean',
            'debuff_chance' => 'nullable|numeric|min:0|max:1',
            'debuff_type' => 'nullable|string|max:50',
            'debuff_stages' => 'nullable|integer',
            'is_legacy' => 'boolean',
            'description' => 'nullable|string',
        ]);

        $validated['has_debuff'] = $request->has('has_debuff');
        $validated['is_legacy'] = $request->has('is_legacy');

        $chargeMove->update($validated);

        return redirect()->route('admin.charge-moves.index')
            ->with('success', 'Ataque carregado atualizado com sucesso!');
    }

    public function destroy(ChargeMove $chargeMove)
    {
        $chargeMove->delete();

        return redirect()->route('admin.charge-moves.index')
            ->with('success', 'Ataque carregado removido com sucesso!');
    }
}
