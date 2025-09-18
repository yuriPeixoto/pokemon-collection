<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-bold text-2xl text-white leading-tight">
                    ✏️ Editar {{ $pokemon->name }}
                </h2>
                <p class="text-white/80 text-sm mt-1">Atualize as informações do seu Pokémon</p>
            </div>
            <a href="{{ route('pokemon.show', $pokemon) }}" class="btn btn-ghost text-white">
                ← Voltar para Detalhes
            </a>
        </div>
    </x-slot>

    <!-- Informações básicas (não editáveis) -->
    <div class="card bg-gradient-to-r from-primary/10 to-secondary/10 shadow-xl mb-6">
        <div class="card-body">
            <h3 class="card-title text-xl mb-4">📊 Informações da PokéAPI (não editáveis)</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="text-center">
                    @if($pokemon->sprite_url)
                        <div class="avatar mb-4">
                            <div class="w-32 h-32 rounded-xl bg-base-200 p-2">
                                <img src="{{ $pokemon->sprite_url }}" alt="{{ $pokemon->name }}" class="w-full h-full object-contain">
                            </div>
                        </div>
                    @endif
                    <h4 class="text-2xl font-bold">{{ $pokemon->name }}</h4>
                    <div class="badge badge-primary badge-lg">#{{ $pokemon->pokedex_number }}</div>
                </div>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="font-medium">🏷️ Tipos:</span>
                        <div class="flex gap-1">
                            @if($pokemon->types)
                                @foreach($pokemon->types as $type)
                                    <span class="badge badge-sm badge-primary">{{ ucfirst($type) }}</span>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    @if($pokemon->region)
                        <div class="flex justify-between">
                            <span class="font-medium">🗺️ Região:</span>
                            <span class="badge badge-outline">{{ $pokemon->region }}</span>
                        </div>
                    @endif
                    @if($pokemon->generation)
                        <div class="flex justify-between">
                            <span class="font-medium">📊 Geração:</span>
                            <span class="badge badge-outline">{{ $pokemon->generation }}</span>
                        </div>
                    @endif
                    
                    @if($pokemon->base_hp || $pokemon->base_attack || $pokemon->base_defense)
                        <div class="divider">📈 Stats Base</div>
                        <div class="grid grid-cols-2 gap-2 text-xs">
                            @if($pokemon->base_hp)
                                <div class="stat bg-base-200 rounded p-2">
                                    <div class="stat-title text-xs">❤️ HP</div>
                                    <div class="stat-value text-lg">{{ $pokemon->base_hp }}</div>
                                </div>
                            @endif
                            @if($pokemon->base_attack)
                                <div class="stat bg-base-200 rounded p-2">
                                    <div class="stat-title text-xs">⚔️ Ataque</div>
                                    <div class="stat-value text-lg">{{ $pokemon->base_attack }}</div>
                                </div>
                            @endif
                            @if($pokemon->base_defense)
                                <div class="stat bg-base-200 rounded p-2">
                                    <div class="stat-title text-xs">🛡️ Defesa</div>
                                    <div class="stat-value text-lg">{{ $pokemon->base_defense }}</div>
                                </div>
                            @endif
                            @if($pokemon->base_speed)
                                <div class="stat bg-base-200 rounded p-2">
                                    <div class="stat-title text-xs">💨 Velocidade</div>
                                    <div class="stat-value text-lg">{{ $pokemon->base_speed }}</div>
                                </div>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <form method="POST" action="{{ route('pokemon.update', $pokemon) }}" id="pokemonEditForm">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">
            <!-- Stats do Pokémon GO -->
            <div class="card bg-base-100 shadow-xl">
                <div class="card-body">
                    <h3 class="card-title text-xl mb-4">⚔️ Stats do Pokémon GO</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-medium">💪 CP (Combat Power)</span>
                            </label>
                            <input type="number" name="cp" value="{{ old('cp', $pokemon->cp) }}" min="0" 
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
                            <input type="number" name="hp" value="{{ old('hp', $pokemon->hp) }}" min="0" 
                                   placeholder="Ex: 150" class="input input-bordered input-primary">
                            @error('hp')
                                <label class="label">
                                    <span class="label-text-alt text-error">{{ $message }}</span>
                                </label>
                            @enderror
                        </div>
                    </div>

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-medium">📈 Nível</span>
                        </label>
                        <input type="number" name="level" value="{{ old('level', $pokemon->level) }}" min="1" max="50" step="0.5" 
                               placeholder="Ex: 25.5" class="input input-bordered input-primary">
                        @error('level')
                            <label class="label">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </label>
                        @enderror
                    </div>

                    <!-- IVs -->
                    <div class="divider">📊 IVs (Individual Values)</div>
                    <div class="grid grid-cols-3 gap-3">
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-medium text-sm">⚔️ Ataque</span>
                            </label>
                            <input type="number" id="iv_attack" name="iv_attack" value="{{ old('iv_attack', $pokemon->iv_attack) }}" 
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
                            <input type="number" id="iv_defense" name="iv_defense" value="{{ old('iv_defense', $pokemon->iv_defense) }}" 
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
                            <input type="number" id="iv_hp" name="iv_hp" value="{{ old('iv_hp', $pokemon->iv_hp) }}" 
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
                            <input type="checkbox" name="is_shiny" value="1" {{ old('is_shiny', $pokemon->is_shiny) ? 'checked' : '' }}
                                   class="checkbox checkbox-primary">
                        </label>
                        <label class="label cursor-pointer">
                            <span class="label-text">🍀 Lucky</span>
                            <input type="checkbox" name="is_lucky" value="1" {{ old('is_lucky', $pokemon->is_lucky) ? 'checked' : '' }}
                                   class="checkbox checkbox-primary">
                        </label>
                        <label class="label cursor-pointer">
                            <span class="label-text">🌑 Shadow</span>
                            <input type="checkbox" name="is_shadow" value="1" {{ old('is_shadow', $pokemon->is_shadow) ? 'checked' : '' }}
                                   class="checkbox checkbox-primary">
                        </label>
                        <label class="label cursor-pointer">
                            <span class="label-text">🕊️ Purified</span>
                            <input type="checkbox" name="is_purified" value="1" {{ old('is_purified', $pokemon->is_purified) ? 'checked' : '' }}
                                   class="checkbox checkbox-primary">
                        </label>
                        <label class="label cursor-pointer">
                            <span class="label-text">👥 Companheiro</span>
                            <input type="checkbox" name="is_buddy" value="1" {{ old('is_buddy', $pokemon->is_buddy) ? 'checked' : '' }}
                                   class="checkbox checkbox-primary">
                        </label>
                    </div>

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-medium">💎 Nível de Companheiro</span>
                        </label>
                        <select name="buddy_level" class="select select-bordered select-primary">
                            <option value="">Selecione...</option>
                            <option value="good" {{ old('buddy_level', $pokemon->buddy_level) == 'good' ? 'selected' : '' }}>🥉 Good Buddy</option>
                            <option value="great" {{ old('buddy_level', $pokemon->buddy_level) == 'great' ? 'selected' : '' }}>🥈 Great Buddy</option>
                            <option value="ultra" {{ old('buddy_level', $pokemon->buddy_level) == 'ultra' ? 'selected' : '' }}>🥇 Ultra Buddy</option>
                            <option value="best" {{ old('buddy_level', $pokemon->buddy_level) == 'best' ? 'selected' : '' }}>💎 Best Buddy</option>
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
                        <select name="fast_move_id" class="select select-bordered select-primary">
                            <option value="">Selecione um ataque rápido</option>
                            @foreach($fastMoves as $move)
                                <option value="{{ $move->id }}" {{ old('fast_move_id', $pokemon->fast_move_id) == $move->id ? 'selected' : '' }}>
                                    {{ $move->display_name }} ({{ $move->type }}) - {{ $move->power }} poder
                                </option>
                            @endforeach
                        </select>
                        <input type="hidden" name="fast_move" value="{{ old('fast_move', $pokemon->fast_move) }}">
                        @error('fast_move_id')
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
                            <select name="charge_move_1_id" class="select select-bordered select-primary">
                                <option value="">Selecione um ataque carregado</option>
                                @foreach($chargeMoves as $move)
                                    <option value="{{ $move->id }}" {{ old('charge_move_1_id', $pokemon->charge_move_1_id) == $move->id ? 'selected' : '' }}>
                                        {{ $move->display_name }} ({{ $move->type }}) - {{ $move->power }} poder - {{ $move->bars_text }}
                                    </option>
                                @endforeach
                            </select>
                            <input type="hidden" name="charge_move_1" value="{{ old('charge_move_1', $pokemon->charge_move_1) }}">
                            @error('charge_move_1_id')
                                <label class="label">
                                    <span class="label-text-alt text-error">{{ $message }}</span>
                                </label>
                            @enderror
                        </div>

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-medium">⚡ Ataque Carregado 2</span>
                            </label>
                            <select name="charge_move_2_id" class="select select-bordered select-primary">
                                <option value="">Selecione um ataque carregado</option>
                                @foreach($chargeMoves as $move)
                                    <option value="{{ $move->id }}" {{ old('charge_move_2_id', $pokemon->charge_move_2_id) == $move->id ? 'selected' : '' }}>
                                        {{ $move->display_name }} ({{ $move->type }}) - {{ $move->power }} poder - {{ $move->bars_text }}
                                    </option>
                                @endforeach
                            </select>
                            <input type="hidden" name="charge_move_2" value="{{ old('charge_move_2', $pokemon->charge_move_2) }}">
                            @error('charge_move_2_id')
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
                        <input type="date" name="caught_at" value="{{ old('caught_at', $pokemon->caught_at?->format('Y-m-d')) }}" 
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
                        <input type="text" name="location_caught" value="{{ old('location_caught', $pokemon->location_caught) }}" 
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
                              class="textarea textarea-bordered textarea-primary">{{ old('notes', $pokemon->notes) }}</textarea>
                    @error('notes')
                        <label class="label">
                            <span class="label-text-alt text-error">{{ $message }}</span>
                        </label>
                    @enderror
                </div>

                <!-- Botões -->
                <div class="card-actions justify-end mt-6">
                    <a href="{{ route('pokemon.show', $pokemon) }}" class="btn btn-ghost">
                        ❌ Cancelar
                    </a>
                    <button type="submit" class="btn btn-primary btn-lg">
                        ✅ Atualizar Pokémon
                    </button>
                </div>
            </div>
        </div>
    </form>

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

            // Calcular IVs iniciais
            calculateIvPercentage();
        });
    </script>
    @endpush
</x-app-layout>