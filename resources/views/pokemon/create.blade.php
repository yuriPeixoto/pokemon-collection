<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-bold text-2xl text-white leading-tight">
                    ➕ Adicionar Novo Pokémon
                </h2>
                <p class="text-white/80 text-sm mt-1">Capture um novo Pokémon para sua coleção</p>
            </div>
            <a href="{{ route('pokemon.index') }}" class="btn btn-ghost text-white">
                ← Voltar para Coleção
            </a>
        </div>
    </x-slot>

    <!-- Busca na PokéAPI -->
    <div class="card bg-base-100 shadow-xl mb-6">
        <div class="card-body">
            <h3 class="card-title text-xl mb-4">🔍 Buscar Pokémon na PokéAPI</h3>
            <div class="form-control">
                <label class="label">
                    <span class="label-text font-medium">📛 Nome do Pokémon</span>
                    <span class="label-text-alt text-base-content/70">Digite em inglês (ex: pikachu)</span>
                </label>
                <div class="flex gap-2">
                    <input type="text" id="name" placeholder="Digite o nome do Pokémon" 
                           class="input input-bordered input-primary flex-1" value="{{ old('name') }}">
                    <button type="button" id="searchBtn" class="btn btn-primary">
                        🔍 Buscar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Preview dos dados da API -->
    <div id="pokemonPreview" class="hidden card bg-gradient-to-r from-primary/10 to-secondary/10 shadow-xl mb-6">
        <div class="card-body">
            <h3 class="card-title text-lg">✨ Dados encontrados na PokéAPI</h3>
            <div id="previewContent"></div>
        </div>
    </div>

    <form method="POST" action="{{ route('pokemon.store') }}" id="pokemonForm">
        @csrf
        <input type="hidden" id="hiddenName" name="name" value="{{ old('name') }}">

        <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">
            <!-- Stats do Pokémon GO -->
            <div class="card bg-base-100 shadow-xl">
                <div class="card-body">
                    <h3 class="card-title text-xl mb-4">⚔️ Stats do Pokémon GO</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-medium">💪 CP</span>
                            </label>
                            <input type="number" name="cp" value="{{ old('cp') }}" min="0" 
                                   placeholder="Ex: 2500" class="input input-bordered input-primary">
                            @error('cp')
                                <label class="label">
                                    <span class="label-text-alt text-error">{{ $message }}</span>
                                </label>
                            @enderror
                        </div>

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-medium">❤️ HP</span>
                            </label>
                            <input type="number" name="hp" value="{{ old('hp') }}" min="0" 
                                   placeholder="Ex: 150" class="input input-bordered input-primary">
                            @error('hp')
                                <label class="label">
                                    <span class="label-text-alt text-error">{{ $message }}</span>
                                </label>
                            @enderror
                        </div>

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-medium">📈 Nível</span>
                            </label>
                            <input type="number" name="level" value="{{ old('level') }}" min="1" max="50" step="0.5" 
                                   placeholder="Ex: 25.5" class="input input-bordered input-primary">
                            @error('level')
                                <label class="label">
                                    <span class="label-text-alt text-error">{{ $message }}</span>
                                </label>
                            @enderror
                        </div>
                    </div>

                    <!-- IVs -->
                    <div class="divider">📊 IVs (Individual Values)</div>
                    <div class="grid grid-cols-3 gap-3">
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-medium text-sm">⚔️ Ataque</span>
                            </label>
                            <input type="number" id="iv_attack" name="iv_attack" value="{{ old('iv_attack') }}" 
                                   min="0" max="15" class="input input-bordered input-primary">
                            @error('iv_attack')
                                <label class="label">
                                    <span class="label-text-alt text-error">{{ $message }}</span>
                                </label>
                            @enderror
                        </div>
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-medium text-sm">🛡️ Defesa</span>
                            </label>
                            <input type="number" id="iv_defense" name="iv_defense" value="{{ old('iv_defense') }}" 
                                   min="0" max="15" class="input input-bordered input-primary">
                            @error('iv_defense')
                                <label class="label">
                                    <span class="label-text-alt text-error">{{ $message }}</span>
                                </label>
                            @enderror
                        </div>
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-medium text-sm">❤️ HP</span>
                            </label>
                            <input type="number" id="iv_hp" name="iv_hp" value="{{ old('iv_hp') }}" 
                                   min="0" max="15" class="input input-bordered input-primary">
                            @error('iv_hp')
                                <label class="label">
                                    <span class="label-text-alt text-error">{{ $message }}</span>
                                </label>
                            @enderror
                        </div>
                    </div>
                    
                    <div id="ivPercentage" class="text-center text-lg font-bold"></div>
                </div>
            </div>

            <!-- Características especiais e ataques -->
            <div class="card bg-base-100 shadow-xl">
                <div class="card-body">
                    <h3 class="card-title text-xl mb-4">✨ Características Especiais</h3>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <label class="label cursor-pointer">
                            <span class="label-text">✨ Shiny</span>
                            <input type="checkbox" name="is_shiny" value="1" {{ old('is_shiny') ? 'checked' : '' }}
                                   class="checkbox checkbox-primary">
                        </label>
                        <label class="label cursor-pointer">
                            <span class="label-text">🍀 Lucky</span>
                            <input type="checkbox" name="is_lucky" value="1" {{ old('is_lucky') ? 'checked' : '' }}
                                   class="checkbox checkbox-primary">
                        </label>
                        <label class="label cursor-pointer">
                            <span class="label-text">🌑 Shadow</span>
                            <input type="checkbox" name="is_shadow" value="1" {{ old('is_shadow') ? 'checked' : '' }}
                                   class="checkbox checkbox-primary">
                        </label>
                        <label class="label cursor-pointer">
                            <span class="label-text">🕊️ Purified</span>
                            <input type="checkbox" name="is_purified" value="1" {{ old('is_purified') ? 'checked' : '' }}
                                   class="checkbox checkbox-primary">
                        </label>
                        <label class="label cursor-pointer">
                            <span class="label-text">👥 Companheiro</span>
                            <input type="checkbox" name="is_buddy" value="1" {{ old('is_buddy') ? 'checked' : '' }}
                                   class="checkbox checkbox-primary">
                        </label>
                    </div>

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-medium">💎 Nível de Companheiro</span>
                        </label>
                        <select name="buddy_level" class="select select-bordered select-primary">
                            <option value="">Selecione...</option>
                            <option value="good" {{ old('buddy_level') == 'good' ? 'selected' : '' }}>🥉 Good Buddy</option>
                            <option value="great" {{ old('buddy_level') == 'great' ? 'selected' : '' }}>🥈 Great Buddy</option>
                            <option value="ultra" {{ old('buddy_level') == 'ultra' ? 'selected' : '' }}>🥇 Ultra Buddy</option>
                            <option value="best" {{ old('buddy_level') == 'best' ? 'selected' : '' }}>💎 Best Buddy</option>
                        </select>
                        @error('buddy_level')
                            <label class="label">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </label>
                        @enderror
                    </div>

                    <div class="divider">⚡ Ataques</div>

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-medium">⚡ Ataque Rápido</span>
                        </label>
                        <input type="text" name="fast_move" value="{{ old('fast_move') }}" 
                               placeholder="Ex: Thunder Shock" class="input input-bordered input-primary">
                        @error('fast_move')
                            <label class="label">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </label>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-medium">💥 Ataque Carregado 1</span>
                            </label>
                            <input type="text" name="charge_move_1" value="{{ old('charge_move_1') }}" 
                                   placeholder="Ex: Thunderbolt" class="input input-bordered input-primary">
                            @error('charge_move_1')
                                <label class="label">
                                    <span class="label-text-alt text-error">{{ $message }}</span>
                                </label>
                            @enderror
                        </div>

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-medium">⚡ Ataque Carregado 2</span>
                            </label>
                            <input type="text" name="charge_move_2" value="{{ old('charge_move_2') }}" 
                                   placeholder="Ex: Wild Charge" class="input input-bordered input-primary">
                            @error('charge_move_2')
                                <label class="label">
                                    <span class="label-text-alt text-error">{{ $message }}</span>
                                </label>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Informações adicionais -->
        <div class="card bg-base-100 shadow-xl mt-6">
            <div class="card-body">
                <h3 class="card-title text-xl mb-4">📋 Informações Adicionais</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-medium">📅 Data de Captura</span>
                        </label>
                        <input type="date" name="caught_at" value="{{ old('caught_at') }}" 
                               class="input input-bordered input-primary">
                        @error('caught_at')
                            <label class="label">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </label>
                        @enderror
                    </div>

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-medium">📍 Local de Captura</span>
                        </label>
                        <input type="text" name="location_caught" value="{{ old('location_caught') }}" 
                               placeholder="Ex: São Paulo, SP" class="input input-bordered input-primary">
                        @error('location_caught')
                            <label class="label">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </label>
                        @enderror
                    </div>
                </div>

                <div class="form-control">
                    <label class="label">
                        <span class="label-text font-medium">📝 Notas</span>
                    </label>
                    <textarea name="notes" rows="3" 
                              placeholder="Adicione observações sobre este Pokémon..." 
                              class="textarea textarea-bordered textarea-primary">{{ old('notes') }}</textarea>
                    @error('notes')
                        <label class="label">
                            <span class="label-text-alt text-error">{{ $message }}</span>
                        </label>
                    @enderror
                </div>

                <!-- Botões -->
                <div class="card-actions justify-end mt-6">
                    <a href="{{ route('pokemon.index') }}" class="btn btn-ghost">
                        ❌ Cancelar
                    </a>
                    <button type="submit" class="btn btn-primary btn-lg">
                        ➕ Adicionar à Coleção
                    </button>
                </div>
            </div>
        </div>
    </form>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchBtn = document.getElementById('searchBtn');
            const nameInput = document.getElementById('name');
            const hiddenNameInput = document.getElementById('hiddenName');
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
                    let badgeClass = 'badge-outline';
                    let emoji = '';
                    
                    if (percentage === 100) {
                        badgeClass = 'badge-secondary';
                        emoji = ' 💯';
                    } else if (percentage >= 90) {
                        badgeClass = 'badge-primary';
                        emoji = ' ⭐';
                    } else if (percentage >= 80) {
                        badgeClass = 'badge-accent';
                        emoji = ' ✨';
                    }
                    
                    ivPercentageDiv.innerHTML = `<div class="badge ${badgeClass} badge-lg">IV Total: ${percentage}%${emoji}</div>`;
                } else {
                    ivPercentageDiv.innerHTML = '';
                }
            }

            // Event listeners para cálculo de IV
            ['iv_attack', 'iv_defense', 'iv_hp'].forEach(id => {
                document.getElementById(id).addEventListener('input', calculateIvPercentage);
            });

            // Sincronizar nome com campo hidden
            nameInput.addEventListener('input', function() {
                hiddenNameInput.value = this.value;
            });

            searchBtn.addEventListener('click', function() {
                const pokemonName = nameInput.value.trim().toLowerCase();
                if (!pokemonName) {
                    alert('Digite o nome do Pokémon');
                    return;
                }

                searchBtn.disabled = true;
                searchBtn.innerHTML = '<span class="loading loading-spinner loading-sm"></span> Buscando...';

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
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.error) {
                        alert('Pokémon não encontrado na PokéAPI');
                        pokemonPreview.classList.add('hidden');
                    } else {
                        showPokemonPreview(data);
                        pokemonPreview.classList.remove('hidden');
                        hiddenNameInput.value = pokemonName;
                    }
                })
                .catch(error => {
                    console.error('Erro:', error);
                    alert(`Erro ao buscar Pokémon: ${error.message}`);
                })
                .finally(() => {
                    searchBtn.disabled = false;
                    searchBtn.innerHTML = '🔍 Buscar';
                });
            });

            function showPokemonPreview(data) {
                previewContent.innerHTML = `
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="text-center">
                            ${data.sprite_url ? `<div class="avatar mb-4"><div class="w-32 h-32 rounded-xl bg-base-200 p-2"><img src="${data.sprite_url}" alt="${data.name}" class="w-full h-full object-contain"></div></div>` : ''}
                            <h4 class="text-2xl font-bold">${data.name}</h4>
                            <div class="badge badge-primary badge-lg">#${data.pokedex_number}</div>
                        </div>
                        <div class="space-y-3">
                            <div class="flex justify-between">
                                <span class="font-medium">🏷️ Tipos:</span>
                                <div class="flex gap-1">
                                    ${data.types.map(type => `<span class="badge badge-sm badge-primary">${type}</span>`).join('')}
                                </div>
                            </div>
                            <div class="flex justify-between">
                                <span class="font-medium">🗺️ Região:</span>
                                <span class="badge badge-outline">${data.region || 'N/A'}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="font-medium">📊 Geração:</span>
                                <span class="badge badge-outline">${data.generation || 'N/A'}</span>
                            </div>
                            <div class="divider">📈 Stats Base</div>
                            <div class="grid grid-cols-2 gap-2 text-xs">
                                <div class="stat bg-base-200 rounded p-2">
                                    <div class="stat-title text-xs">❤️ HP</div>
                                    <div class="stat-value text-lg">${data.base_hp}</div>
                                </div>
                                <div class="stat bg-base-200 rounded p-2">
                                    <div class="stat-title text-xs">⚔️ Ataque</div>
                                    <div class="stat-value text-lg">${data.base_attack}</div>
                                </div>
                                <div class="stat bg-base-200 rounded p-2">
                                    <div class="stat-title text-xs">🛡️ Defesa</div>
                                    <div class="stat-value text-lg">${data.base_defense}</div>
                                </div>
                                <div class="stat bg-base-200 rounded p-2">
                                    <div class="stat-title text-xs">💨 Velocidade</div>
                                    <div class="stat-value text-lg">${data.base_speed}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
            }
        });
    </script>
    @endpush
</x-app-layout>