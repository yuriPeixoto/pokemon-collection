<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Adicionar Pokémon') }}
            </h2>
            <a href="{{ route('pokemon.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Voltar para Lista
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('pokemon.store') }}" id="pokemonForm">
                        @csrf

                        <!-- Busca na PokéAPI -->
                        <div class="mb-6">
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nome do Pokémon</label>
                            <div class="flex">
                                <input type="text" id="name" name="name" value="{{ old('name') }}" required
                                       class="flex-1 rounded-l-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                       placeholder="Digite o nome em inglês (ex: pikachu)">
                                <button type="button" id="searchBtn"
                                        class="px-4 py-2 bg-blue-500 hover:bg-blue-700 text-white font-bold rounded-r-md">
                                    Buscar na PokéAPI
                                </button>
                            </div>
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Preview dos dados da API -->
                        <div id="pokemonPreview" class="hidden mb-6 p-4 bg-gray-50 rounded-lg">
                            <h3 class="text-lg font-medium text-gray-900 mb-3">Dados encontrados na PokéAPI:</h3>
                            <div id="previewContent"></div>
                        </div>

                        <!-- Dados específicos do Pokémon GO -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Stats do Pokémon GO -->
                            <div class="space-y-4">
                                <h3 class="text-lg font-medium text-gray-900">Stats do Pokémon GO</h3>

                                <div>
                                    <label for="cp" class="block text-sm font-medium text-gray-700">CP (Combat Power)</label>
                                    <input type="number" id="cp" name="cp" value="{{ old('cp') }}" min="0"
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    @error('cp')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="hp" class="block text-sm font-medium text-gray-700">HP</label>
                                    <input type="number" id="hp" name="hp" value="{{ old('hp') }}" min="0"
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    @error('hp')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- IVs -->
                                <div class="grid grid-cols-3 gap-3">
                                    <div>
                                        <label for="iv_attack" class="block text-sm font-medium text-gray-700">IV Ataque</label>
                                        <input type="number" id="iv_attack" name="iv_attack" value="{{ old('iv_attack') }}" min="0" max="15"
                                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                        @error('iv_attack')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div>
                                        <label for="iv_defense" class="block text-sm font-medium text-gray-700">IV Defesa</label>
                                        <input type="number" id="iv_defense" name="iv_defense" value="{{ old('iv_defense') }}" min="0" max="15"
                                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                        @error('iv_defense')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div>
                                        <label for="iv_hp" class="block text-sm font-medium text-gray-700">IV HP</label>
                                        <input type="number" id="iv_hp" name="iv_hp" value="{{ old('iv_hp') }}" min="0" max="15"
                                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                        @error('iv_hp')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div id="ivPercentage" class="text-sm text-gray-600"></div>

                                <div>
                                    <label for="level" class="block text-sm font-medium text-gray-700">Nível</label>
                                    <input type="number" id="level" name="level" value="{{ old('level') }}" min="1" max="50" step="0.5"
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                           placeholder="Ex: 25.5">
                                    @error('level')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Características especiais e ataques -->
                            <div class="space-y-4">
                                <h3 class="text-lg font-medium text-gray-900">Características Especiais</h3>

                                <div class="space-y-3">
                                    <label class="flex items-center">
                                        <input type="checkbox" name="is_shiny" value="1" {{ old('is_shiny') ? 'checked' : '' }}
                                               class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                        <span class="ml-2 text-sm text-gray-700">Shiny ✨</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="checkbox" name="is_lucky" value="1" {{ old('is_lucky') ? 'checked' : '' }}
                                               class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                        <span class="ml-2 text-sm text-gray-700">Lucky 🍀</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="checkbox" name="is_shadow" value="1" {{ old('is_shadow') ? 'checked' : '' }}
                                               class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                        <span class="ml-2 text-sm text-gray-700">Shadow 🌑</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="checkbox" name="is_purified" value="1" {{ old('is_purified') ? 'checked' : '' }}
                                               class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                        <span class="ml-2 text-sm text-gray-700">Purified 🕊️</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="checkbox" name="is_buddy" value="1" {{ old('is_buddy') ? 'checked' : '' }}
                                               class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                        <span class="ml-2 text-sm text-gray-700">É meu Companheiro 👥</span>
                                    </label>
                                </div>

                                <div>
                                    <label for="buddy_level" class="block text-sm font-medium text-gray-700">Nível Máximo de Companheiro</label>
                                    <select id="buddy_level" name="buddy_level" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                        <option value="">Selecione o nível...</option>
                                        <option value="good" {{ old('buddy_level') == 'good' ? 'selected' : '' }}>Good Buddy 🥉</option>
                                        <option value="great" {{ old('buddy_level') == 'great' ? 'selected' : '' }}>Great Buddy 🥈</option>
                                        <option value="ultra" {{ old('buddy_level') == 'ultra' ? 'selected' : '' }}>Ultra Buddy 🥇</option>
                                        <option value="best" {{ old('buddy_level') == 'best' ? 'selected' : '' }}>Best Buddy 💎</option>
                                    </select>
                                    @error('buddy_level')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="fast_move" class="block text-sm font-medium text-gray-700">Ataque Rápido</label>
                                    <input type="text" id="fast_move" name="fast_move" value="{{ old('fast_move') }}"
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    @error('fast_move')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="charge_move_1" class="block text-sm font-medium text-gray-700">Ataque Carregado 1</label>
                                    <input type="text" id="charge_move_1" name="charge_move_1" value="{{ old('charge_move_1') }}"
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    @error('charge_move_1')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="charge_move_2" class="block text-sm font-medium text-gray-700">Ataque Carregado 2</label>
                                    <input type="text" id="charge_move_2" name="charge_move_2" value="{{ old('charge_move_2') }}"
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
                                <input type="date" id="caught_at" name="caught_at" value="{{ old('caught_at') }}"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                @error('caught_at')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="location_caught" class="block text-sm font-medium text-gray-700">Local de Captura</label>
                                <input type="text" id="location_caught" name="location_caught" value="{{ old('location_caught') }}"
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
                                      placeholder="Adicione observações sobre este Pokémon...">{{ old('notes') }}</textarea>
                            @error('notes')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Botões -->
                        <div class="mt-6 flex justify-end space-x-3">
                            <a href="{{ route('pokemon.index') }}"
                               class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Cancelar
                            </a>
                            <button type="submit"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Adicionar Pokémon
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
            const searchBtn = document.getElementById('searchBtn');
            const nameInput = document.getElementById('name');
            const pokemonPreview = document.getElementById('pokemonPreview');
            const previewContent = document.getElementById('previewContent');

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

            searchBtn.addEventListener('click', function() {
                const pokemonName = nameInput.value.trim().toLowerCase();
                if (!pokemonName) {
                    alert('Digite o nome do Pokémon');
                    return;
                }

                searchBtn.disabled = true;
                searchBtn.textContent = 'Buscando...';

                // Debug da URL
                console.log('URL da requisição:', '{{ route("pokemon.search.api") }}');

                const formData = new FormData();
                formData.append('name', pokemonName);
                formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));

                fetch('{{ route("pokemon.search.api") }}', {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: formData
                })
                .then(response => {
                    console.log('Response status:', response.status);
                    console.log('Response URL:', response.url);
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Response data:', data);
                    if (data.error) {
                        alert('Pokémon não encontrado na PokéAPI');
                        pokemonPreview.classList.add('hidden');
                    } else {
                        showPokemonPreview(data);
                        pokemonPreview.classList.remove('hidden');
                    }
                })
                .catch(error => {
                    console.error('Erro completo:', error);
                    alert(`Erro ao buscar Pokémon: ${error.message}`);
                })
                .finally(() => {
                    searchBtn.disabled = false;
                    searchBtn.textContent = 'Buscar na PokéAPI';
                });
            });

            function showPokemonPreview(data) {
                previewContent.innerHTML = `
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            ${data.sprite_url ? `<img src="${data.sprite_url}" alt="${data.name}" class="w-32 h-32 mx-auto">` : ''}
                            <h4 class="text-lg font-semibold text-center">${data.name}</h4>
                            <p class="text-center text-gray-600">#${data.pokedex_number}</p>
                        </div>
                        <div class="space-y-2 text-sm">
                            <div><strong>Tipos:</strong> ${data.types.join(', ')}</div>
                            <div><strong>Região:</strong> ${data.region || 'N/A'}</div>
                            <div><strong>Geração:</strong> ${data.generation || 'N/A'}</div>
                            <div class="mt-3">
                                <strong>Stats Base:</strong>
                                <ul class="list-disc list-inside mt-1 space-y-1">
                                    <li>HP: ${data.base_hp}</li>
                                    <li>Ataque: ${data.base_attack}</li>
                                    <li>Defesa: ${data.base_defense}</li>
                                    <li>Sp. Ataque: ${data.base_special_attack}</li>
                                    <li>Sp. Defesa: ${data.base_special_defense}</li>
                                    <li>Velocidade: ${data.base_speed}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                `;
            }
        });
    </script>
    @endpush
</x-app-layout>