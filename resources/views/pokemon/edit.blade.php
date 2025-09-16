<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Editar') }} {{ $pokemon->name }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('pokemon.show', $pokemon) }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Cancelar
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Informações básicas (não editáveis) -->
                    <div class="mb-6 bg-gray-50 rounded-lg p-4">
                        <h3 class="text-lg font-semibold text-gray-900 mb-3">Informações da PokéAPI (não editáveis)</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="space-y-2">
                                @if($pokemon->sprite_url)
                                    <div class="flex justify-center md:justify-start">
                                        <img src="{{ $pokemon->sprite_url }}" alt="{{ $pokemon->name }}" class="w-24 h-24">
                                    </div>
                                @endif
                                <div><strong>Nome:</strong> {{ $pokemon->name }}</div>
                                <div><strong>Número:</strong> #{{ $pokemon->pokedex_number }}</div>
                                <div><strong>Tipos:</strong> {{ $pokemon->types_string }}</div>
                            </div>
                            <div class="space-y-2 text-sm">
                                @if($pokemon->region)
                                    <div><strong>Região:</strong> {{ $pokemon->region }}</div>
                                @endif
                                @if($pokemon->generation)
                                    <div><strong>Geração:</strong> {{ $pokemon->generation }}</div>
                                @endif
                                <div class="mt-2">
                                    <strong>Stats Base:</strong>
                                    <div class="mt-1 space-y-1">
                                        @if($pokemon->base_hp)<div>HP: {{ $pokemon->base_hp }}</div>@endif
                                        @if($pokemon->base_attack)<div>Ataque: {{ $pokemon->base_attack }}</div>@endif
                                        @if($pokemon->base_defense)<div>Defesa: {{ $pokemon->base_defense }}</div>@endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('pokemon.update', $pokemon) }}" id="pokemonEditForm">
                        @csrf
                        @method('PUT')

                        <!-- Dados específicos do Pokémon GO -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Stats do Pokémon GO -->
                            <div class="space-y-4">
                                <h3 class="text-lg font-medium text-gray-900">Stats do Pokémon GO</h3>

                                <div>
                                    <label for="cp" class="block text-sm font-medium text-gray-700">CP (Combat Power)</label>
                                    <input type="number" id="cp" name="cp" value="{{ old('cp', $pokemon->cp) }}" min="0"
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    @error('cp')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="hp" class="block text-sm font-medium text-gray-700">HP</label>
                                    <input type="number" id="hp" name="hp" value="{{ old('hp', $pokemon->hp) }}" min="0"
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    @error('hp')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- IVs -->
                                <div class="grid grid-cols-3 gap-3">
                                    <div>
                                        <label for="iv_attack" class="block text-sm font-medium text-gray-700">IV Ataque</label>
                                        <input type="number" id="iv_attack" name="iv_attack" value="{{ old('iv_attack', $pokemon->iv_attack) }}" min="0" max="15"
                                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                        @error('iv_attack')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div>
                                        <label for="iv_defense" class="block text-sm font-medium text-gray-700">IV Defesa</label>
                                        <input type="number" id="iv_defense" name="iv_defense" value="{{ old('iv_defense', $pokemon->iv_defense) }}" min="0" max="15"
                                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                        @error('iv_defense')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div>
                                        <label for="iv_hp" class="block text-sm font-medium text-gray-700">IV HP</label>
                                        <input type="number" id="iv_hp" name="iv_hp" value="{{ old('iv_hp', $pokemon->iv_hp) }}" min="0" max="15"
                                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                        @error('iv_hp')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div id="ivPercentage" class="text-sm text-gray-600"></div>
                            </div>

                            <!-- Características especiais e ataques -->
                            <div class="space-y-4">
                                <h3 class="text-lg font-medium text-gray-900">Características Especiais</h3>

                                <div class="space-y-3">
                                    <label class="flex items-center">
                                        <input type="checkbox" name="is_shiny" value="1" {{ old('is_shiny', $pokemon->is_shiny) ? 'checked' : '' }}
                                               class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                        <span class="ml-2 text-sm text-gray-700">Shiny ✨</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="checkbox" name="is_lucky" value="1" {{ old('is_lucky', $pokemon->is_lucky) ? 'checked' : '' }}
                                               class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                        <span class="ml-2 text-sm text-gray-700">Lucky 🍀</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="checkbox" name="is_shadow" value="1" {{ old('is_shadow', $pokemon->is_shadow) ? 'checked' : '' }}
                                               class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                        <span class="ml-2 text-sm text-gray-700">Shadow 🌑</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="checkbox" name="is_purified" value="1" {{ old('is_purified', $pokemon->is_purified) ? 'checked' : '' }}
                                               class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                        <span class="ml-2 text-sm text-gray-700">Purified 🕊️</span>
                                    </label>
                                </div>

                                <div>
                                    <label for="fast_move" class="block text-sm font-medium text-gray-700">Ataque Rápido</label>
                                    <input type="text" id="fast_move" name="fast_move" value="{{ old('fast_move', $pokemon->fast_move) }}"
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    @error('fast_move')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="charge_move_1" class="block text-sm font-medium text-gray-700">Ataque Carregado 1</label>
                                    <input type="text" id="charge_move_1" name="charge_move_1" value="{{ old('charge_move_1', $pokemon->charge_move_1) }}"
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    @error('charge_move_1')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="charge_move_2" class="block text-sm font-medium text-gray-700">Ataque Carregado 2</label>
                                    <input type="text" id="charge_move_2" name="charge_move_2" value="{{ old('charge_move_2', $pokemon->charge_move_2) }}"
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    @error('charge_move_2')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Informações adicionais -->
                        <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="caught_at" class="block text-sm font-medium text-gray-700">Data de Captura</label>
                                <input type="date" id="caught_at" name="caught_at" value="{{ old('caught_at', $pokemon->caught_at?->format('Y-m-d')) }}"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                @error('caught_at')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="location_caught" class="block text-sm font-medium text-gray-700">Local de Captura</label>
                                <input type="text" id="location_caught" name="location_caught" value="{{ old('location_caught', $pokemon->location_caught) }}"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                       placeholder="Ex: São Paulo, SP">
                                @error('location_caught')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-6">
                            <label for="notes" class="block text-sm font-medium text-gray-700">Notas</label>
                            <textarea id="notes" name="notes" rows="3"
                                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                      placeholder="Adicione observações sobre este Pokémon...">{{ old('notes', $pokemon->notes) }}</textarea>
                            @error('notes')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Botões -->
                        <div class="mt-6 flex justify-end space-x-3">
                            <a href="{{ route('pokemon.show', $pokemon) }}"
                               class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Cancelar
                            </a>
                            <button type="submit"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Atualizar Pokémon
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Calcular IV percentage
            function calculateIvPercentage() {
                const ivAttack = parseInt(document.getElementById('iv_attack').value) || 0;
                const ivDefense = parseInt(document.getElementById('iv_defense').value) || 0;
                const ivHp = parseInt(document.getElementById('iv_hp').value) || 0;

                const total = ivAttack + ivDefense + ivHp;
                const percentage = Math.round((total / 45) * 100 * 100) / 100;

                const ivPercentageDiv = document.getElementById('ivPercentage');
                if (total > 0) {
                    ivPercentageDiv.innerHTML = `<strong>IV Total: ${percentage}%</strong> ${percentage === 100 ? '💯' : ''}`;
                    if (percentage === 100) {
                        ivPercentageDiv.classList.add('text-purple-600', 'font-bold');
                    } else {
                        ivPercentageDiv.classList.remove('text-purple-600', 'font-bold');
                    }
                } else {
                    ivPercentageDiv.innerHTML = '';
                }
            }

            // Event listeners para cálculo de IV
            ['iv_attack', 'iv_defense', 'iv_hp'].forEach(id => {
                document.getElementById(id).addEventListener('input', calculateIvPercentage);
            });

            // Calcular IVs iniciais
            calculateIvPercentage();
        });
    </script>
    @endpush
</x-app-layout>