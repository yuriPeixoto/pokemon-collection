<?php

namespace App\Http\Controllers;

use App\Models\Pokemon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Rule;

class PokemonController extends Controller
{
    public function index(Request $request)
    {
        $query = auth()->user()->pokemon();

        // Filtros
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('type')) {
            $query->byType($request->type);
        }

        if ($request->filled('region')) {
            $query->byRegion($request->region);
        }

        if ($request->boolean('perfect_iv')) {
            $query->perfectIv();
        }

        if ($request->boolean('shiny')) {
            $query->shiny();
        }

        if ($request->boolean('lucky')) {
            $query->lucky();
        }

        if ($request->boolean('shadow')) {
            $query->where('is_shadow', true);
        }

        if ($request->boolean('purified')) {
            $query->where('is_purified', true);
        }

        $pokemon = $query->orderBy('name')->paginate(20);

        return view('pokemon.index', compact('pokemon'));
    }

    public function create()
    {
        return view('pokemon.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'cp' => 'nullable|integer|min:0',
            'hp' => 'nullable|integer|min:0',
            'iv_attack' => 'nullable|integer|min:0|max:15',
            'iv_defense' => 'nullable|integer|min:0|max:15',
            'iv_hp' => 'nullable|integer|min:0|max:15',
            'level' => 'nullable|numeric|min:1|max:50',
            'is_shiny' => 'boolean',
            'is_lucky' => 'boolean',
            'is_shadow' => 'boolean',
            'is_purified' => 'boolean',
            'is_buddy' => 'boolean',
            'buddy_level' => 'nullable|in:good,great,ultra,best',
            'fast_move' => 'nullable|string|max:255',
            'charge_move_1' => 'nullable|string|max:255',
            'charge_move_2' => 'nullable|string|max:255',
            'caught_at' => 'nullable|date',
            'location_caught' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);

        // Buscar dados da PokéAPI
        $pokemonData = $this->fetchPokemonData(strtolower($validated['name']));

        if (!$pokemonData) {
            return back()->withErrors(['name' => 'Pokémon não encontrado na PokéAPI.']);
        }

        // Calcular IV percentage
        if (isset($validated['iv_attack']) && isset($validated['iv_defense']) && isset($validated['iv_hp'])) {
            $validated['iv_percentage'] = round((($validated['iv_attack'] + $validated['iv_defense'] + $validated['iv_hp']) / 45) * 100, 2);
            $validated['is_perfect_iv'] = $validated['iv_attack'] === 15 && $validated['iv_defense'] === 15 && $validated['iv_hp'] === 15;
        }

        // Merge dados da API
        $validated = array_merge($validated, $pokemonData);
        $validated['user_id'] = auth()->id();

        Pokemon::create($validated);

        return redirect()->route('pokemon.index')->with('success', 'Pokémon adicionado com sucesso!');
    }

    public function show(Pokemon $pokemon)
    {
        $this->authorize('view', $pokemon);
        return view('pokemon.show', compact('pokemon'));
    }

    public function edit(Pokemon $pokemon)
    {
        $this->authorize('update', $pokemon);
        return view('pokemon.edit', compact('pokemon'));
    }

    public function update(Request $request, Pokemon $pokemon)
    {
        $this->authorize('update', $pokemon);

        $validated = $request->validate([
            'cp' => 'nullable|integer|min:0',
            'hp' => 'nullable|integer|min:0',
            'iv_attack' => 'nullable|integer|min:0|max:15',
            'iv_defense' => 'nullable|integer|min:0|max:15',
            'iv_hp' => 'nullable|integer|min:0|max:15',
            'level' => 'nullable|numeric|min:1|max:50',
            'is_shiny' => 'boolean',
            'is_lucky' => 'boolean',
            'is_shadow' => 'boolean',
            'is_purified' => 'boolean',
            'is_buddy' => 'boolean',
            'buddy_level' => 'nullable|in:good,great,ultra,best',
            'fast_move' => 'nullable|string|max:255',
            'charge_move_1' => 'nullable|string|max:255',
            'charge_move_2' => 'nullable|string|max:255',
            'caught_at' => 'nullable|date',
            'location_caught' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);

        // Recalcular IV percentage
        if (isset($validated['iv_attack']) && isset($validated['iv_defense']) && isset($validated['iv_hp'])) {
            $validated['iv_percentage'] = round((($validated['iv_attack'] + $validated['iv_defense'] + $validated['iv_hp']) / 45) * 100, 2);
            $validated['is_perfect_iv'] = $validated['iv_attack'] === 15 && $validated['iv_defense'] === 15 && $validated['iv_hp'] === 15;
        }

        $pokemon->update($validated);

        return redirect()->route('pokemon.show', $pokemon)->with('success', 'Pokémon atualizado com sucesso!');
    }

    public function destroy(Pokemon $pokemon)
    {
        $this->authorize('delete', $pokemon);
        $pokemon->delete();

        return redirect()->route('pokemon.index')->with('success', 'Pokémon removido com sucesso!');
    }

    public function searchApi(Request $request)
    {
        try {
            // Log para debug
            \Log::info('searchApi called with data: ', $request->all());

            $request->validate(['name' => 'required|string']);

            // Teste simples primeiro
            if ($request->name === 'test') {
                return response()->json([
                    'name' => 'Test Pokemon',
                    'pokedex_number' => 1,
                    'types' => ['normal'],
                    'sprite_url' => null,
                    'base_hp' => 100,
                    'base_attack' => 100,
                    'base_defense' => 100,
                    'base_special_attack' => 100,
                    'base_special_defense' => 100,
                    'base_speed' => 100,
                    'generation' => 'I',
                    'region' => 'Test'
                ]);
            }

            $pokemonData = $this->fetchPokemonData(strtolower($request->name));

            if (!$pokemonData) {
                return response()->json(['error' => 'Pokémon não encontrado'], 404);
            }

            return response()->json($pokemonData);
        } catch (\Exception $e) {
            \Log::error('Error in searchApi: ' . $e->getMessage());
            return response()->json(['error' => 'Erro interno: ' . $e->getMessage()], 500);
        }
    }

    private function fetchPokemonData($name)
    {
        try {
            \Log::info("Fetching Pokemon data for: {$name}");

            // Temporariamente usar file_get_contents para debug
            $json = file_get_contents("https://pokeapi.co/api/v2/pokemon/{$name}");
            if ($json === false) {
                \Log::error("file_get_contents failed for: {$name}");
                return null;
            }

            $data = json_decode($json, true);
            if (!$data) {
                \Log::error("JSON decode failed for: {$name}");
                return null;
            }

            \Log::info("Successfully fetched data using file_get_contents for: {$name}, ID: " . $data['id']);

            // Buscar dados da espécie para região/geração
            $speciesJson = file_get_contents($data['species']['url']);
            $speciesData = $speciesJson ? json_decode($speciesJson, true) : null;

            return [
                'name' => ucfirst($data['name']),
                'pokedex_number' => $data['id'],
                'types' => collect($data['types'])->pluck('type.name')->toArray(),
                'sprite_url' => $data['sprites']['front_default'],
                'base_hp' => $data['stats'][0]['base_stat'],
                'base_attack' => $data['stats'][1]['base_stat'],
                'base_defense' => $data['stats'][2]['base_stat'],
                'base_special_attack' => $data['stats'][3]['base_stat'],
                'base_special_defense' => $data['stats'][4]['base_stat'],
                'base_speed' => $data['stats'][5]['base_stat'],
                'generation' => $speciesData ? $this->getGenerationName($speciesData['generation']['name']) : null,
                'region' => $speciesData ? $this->getRegionFromGeneration($speciesData['generation']['name']) : null,
            ];
        } catch (\Exception $e) {
            \Log::error("Exception in fetchPokemonData: " . $e->getMessage());
            \Log::error("Stack trace: " . $e->getTraceAsString());
            return null;
        }
    }

    private function getGenerationName($generation)
    {
        $generations = [
            'generation-i' => 'I',
            'generation-ii' => 'II',
            'generation-iii' => 'III',
            'generation-iv' => 'IV',
            'generation-v' => 'V',
            'generation-vi' => 'VI',
            'generation-vii' => 'VII',
            'generation-viii' => 'VIII',
            'generation-ix' => 'IX',
        ];

        return $generations[$generation] ?? null;
    }

    private function getRegionFromGeneration($generation)
    {
        $regions = [
            'generation-i' => 'Kanto',
            'generation-ii' => 'Johto',
            'generation-iii' => 'Hoenn',
            'generation-iv' => 'Sinnoh',
            'generation-v' => 'Unova',
            'generation-vi' => 'Kalos',
            'generation-vii' => 'Alola',
            'generation-viii' => 'Galar',
            'generation-ix' => 'Paldea',
        ];

        return $regions[$generation] ?? null;
    }
}
