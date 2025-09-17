<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-bold text-2xl text-white leading-tight flex items-center gap-2">
                    👁️ {{ $pokemon->name }}
                    @if($pokemon->is_shiny) <span class="badge badge-accent">✨ Shiny</span> @endif
                    @if($pokemon->is_lucky) <span class="badge badge-success">🍀 Lucky</span> @endif
                    @if($pokemon->is_perfect_iv) <span class="badge badge-secondary">💯 Perfect</span> @endif
                </h2>
                <p class="text-white/80 text-sm mt-1">Detalhes completos do seu Pokémon</p>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('pokemon.edit', $pokemon) }}" class="btn btn-accent">
                    Editar
                </a>
                <a href="{{ route('pokemon.index') }}" class="btn btn-ghost text-white">
                    ← Voltar
                </a>
            </div>
        </div>
    </x-slot>

    <!-- Messages -->
    @if (session('success'))
        <div class="alert alert-success shadow-lg mb-6">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                <span>{{ session('success') }}</span>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-error shadow-lg mb-6">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                <span>{{ session('error') }}</span>
            </div>
        </div>
    @endif

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
        <!-- Informações Básicas e Sprite -->
        <div class="xl:col-span-1">
            <div class="card bg-base-100 shadow-xl">
                <div class="card-body items-center text-center">
                    @if($pokemon->sprite_url)
                        <div class="avatar mb-6">
                            <div class="w-48 h-48 rounded-2xl bg-gradient-to-br from-primary/10 to-secondary/10 p-4">
                                <img src="{{ $pokemon->sprite_url }}" alt="{{ $pokemon->name }}" class="w-full h-full object-contain">
                            </div>
                        </div>
                    @endif

                    <div class="card-title text-3xl">{{ $pokemon->name }}</div>
                    <div class="badge badge-primary badge-lg mb-4">#{{ $pokemon->pokedex_number }}</div>

                    <!-- Badges especiais -->
                    <div class="flex flex-wrap gap-2 justify-center mb-4">
                        @if($pokemon->is_shiny)
                            <div class="badge badge-accent">✨ Shiny</div>
                        @endif
                        @if($pokemon->is_lucky)
                            <div class="badge badge-success">🍀 Lucky</div>
                        @endif
                        @if($pokemon->is_perfect_iv)
                            <div class="badge badge-secondary">💯 Perfect IV</div>
                        @endif
                        @if($pokemon->is_shadow)
                            <div class="badge badge-neutral">🌑 Shadow</div>
                        @endif
                        @if($pokemon->is_purified)
                            <div class="badge badge-primary">✨ Purified</div>
                        @endif
                        @if($pokemon->is_buddy)
                            <div class="badge badge-info">👥 Companheiro</div>
                        @endif
                    </div>

                    <!-- Tipos -->
                    <div class="flex gap-2 justify-center">
                        @if($pokemon->types)
                            @foreach($pokemon->types as $type)
                                @php
                                    $typeInfo = \App\Models\Pokemon::getTypeInfo($type);
                                @endphp
                                <div class="badge badge-lg text-white" style="background-color: {{ $typeInfo['color'] }}">
                                    {{ $typeInfo['emoji'] }} {{ $typeInfo['name'] }}
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>

            <!-- Informações da PokéAPI -->
            <div class="card bg-gradient-to-r from-primary/10 to-secondary/10 shadow-xl mt-6">
                <div class="card-body">
                    <h3 class="card-title">📊 Dados da PokéAPI</h3>
                    <div class="space-y-3">
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
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats e Informações do GO -->
        <div class="xl:col-span-2 space-y-6">
            <!-- Stats do Pokémon GO -->
            <div class="card bg-base-100 shadow-xl">
                <div class="card-body">
                    <h3 class="card-title text-xl mb-4">⚔️ Stats do Pokémon GO</h3>
                    
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                        <div class="stat bg-base-200 rounded-lg">
                            <div class="stat-figure text-primary">
                                <span class="text-2xl">💪</span>
                            </div>
                            <div class="stat-title">CP</div>
                            <div class="stat-value text-primary">{{ $pokemon->cp ?? 'N/A' }}</div>
                        </div>
                        
                        <div class="stat bg-base-200 rounded-lg">
                            <div class="stat-figure text-error">
                                <span class="text-2xl">❤️</span>
                            </div>
                            <div class="stat-title">HP</div>
                            <div class="stat-value text-error">{{ $pokemon->hp ?? 'N/A' }}</div>
                        </div>
                        
                        @if($pokemon->level)
                            <div class="stat bg-base-200 rounded-lg">
                                <div class="stat-figure text-accent">
                                    <span class="text-2xl">📈</span>
                                </div>
                                <div class="stat-title">Nível</div>
                                <div class="stat-value text-accent">{{ $pokemon->level }}</div>
                            </div>
                        @endif
                        
                        @if($pokemon->iv_percentage)
                            <div class="stat bg-base-200 rounded-lg">
                                <div class="stat-figure {{ $pokemon->is_perfect_iv ? 'text-secondary' : 'text-info' }}">
                                    <span class="text-2xl">📊</span>
                                </div>
                                <div class="stat-title">IV Total</div>
                                <div class="stat-value {{ $pokemon->is_perfect_iv ? 'text-secondary' : 'text-info' }}">{{ $pokemon->iv_percentage }}%</div>
                            </div>
                        @endif
                    </div>

                    <!-- IVs Detalhados -->
                    @if($pokemon->iv_attack !== null || $pokemon->iv_defense !== null || $pokemon->iv_hp !== null)
                        <div class="divider">📊 IVs Individuais</div>
                        <div class="grid grid-cols-3 gap-4">
                            <div class="text-center">
                                <div class="text-2xl">⚔️</div>
                                <div class="font-bold text-lg">{{ $pokemon->iv_attack ?? 'N/A' }}</div>
                                <div class="text-sm opacity-70">Ataque</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl">🛡️</div>
                                <div class="font-bold text-lg">{{ $pokemon->iv_defense ?? 'N/A' }}</div>
                                <div class="text-sm opacity-70">Defesa</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl">❤️</div>
                                <div class="font-bold text-lg">{{ $pokemon->iv_hp ?? 'N/A' }}</div>
                                <div class="text-sm opacity-70">HP</div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Stats Base -->
            @if($pokemon->base_hp || $pokemon->base_attack || $pokemon->base_defense)
                <div class="card bg-base-100 shadow-xl">
                    <div class="card-body">
                        <h3 class="card-title text-xl mb-4">📈 Stats Base (PokéAPI)</h3>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                            @if($pokemon->base_hp)
                                <div class="stat bg-base-200 rounded-lg">
                                    <div class="stat-title">❤️ HP</div>
                                    <div class="stat-value text-lg">{{ $pokemon->base_hp }}</div>
                                </div>
                            @endif
                            @if($pokemon->base_attack)
                                <div class="stat bg-base-200 rounded-lg">
                                    <div class="stat-title">⚔️ Ataque</div>
                                    <div class="stat-value text-lg">{{ $pokemon->base_attack }}</div>
                                </div>
                            @endif
                            @if($pokemon->base_defense)
                                <div class="stat bg-base-200 rounded-lg">
                                    <div class="stat-title">🛡️ Defesa</div>
                                    <div class="stat-value text-lg">{{ $pokemon->base_defense }}</div>
                                </div>
                            @endif
                            @if($pokemon->base_special_attack)
                                <div class="stat bg-base-200 rounded-lg">
                                    <div class="stat-title">⚡ Sp. Ataque</div>
                                    <div class="stat-value text-lg">{{ $pokemon->base_special_attack }}</div>
                                </div>
                            @endif
                            @if($pokemon->base_special_defense)
                                <div class="stat bg-base-200 rounded-lg">
                                    <div class="stat-title">🔰 Sp. Defesa</div>
                                    <div class="stat-value text-lg">{{ $pokemon->base_special_defense }}</div>
                                </div>
                            @endif
                            @if($pokemon->base_speed)
                                <div class="stat bg-base-200 rounded-lg">
                                    <div class="stat-title">💨 Velocidade</div>
                                    <div class="stat-value text-lg">{{ $pokemon->base_speed }}</div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endif

            <!-- Ataques -->
            @if($pokemon->fast_move || $pokemon->charge_move_1 || $pokemon->charge_move_2)
                <div class="card bg-base-100 shadow-xl">
                    <div class="card-body">
                        <h3 class="card-title text-xl mb-4">⚡ Ataques</h3>
                        <div class="space-y-4">
                            @if($pokemon->fast_move)
                                <div class="flex items-center gap-4 p-3 bg-base-200 rounded-lg">
                                    <div class="text-2xl">⚡</div>
                                    <div>
                                        <div class="font-bold">Ataque Rápido</div>
                                        <div class="text-primary">{{ $pokemon->fast_move }}</div>
                                    </div>
                                </div>
                            @endif
                            @if($pokemon->charge_move_1)
                                <div class="flex items-center gap-4 p-3 bg-base-200 rounded-lg">
                                    <div class="text-2xl">💥</div>
                                    <div>
                                        <div class="font-bold">Ataque Carregado 1</div>
                                        <div class="text-secondary">{{ $pokemon->charge_move_1 }}</div>
                                    </div>
                                </div>
                            @endif
                            @if($pokemon->charge_move_2)
                                <div class="flex items-center gap-4 p-3 bg-base-200 rounded-lg">
                                    <div class="text-2xl">⚡</div>
                                    <div>
                                        <div class="font-bold">Ataque Carregado 2</div>
                                        <div class="text-accent">{{ $pokemon->charge_move_2 }}</div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endif

            <!-- Informações de Captura -->
            @if($pokemon->caught_at || $pokemon->location_caught || $pokemon->notes)
                <div class="card bg-base-100 shadow-xl">
                    <div class="card-body">
                        <h3 class="card-title text-xl mb-4">📋 Informações de Captura</h3>
                        <div class="space-y-4">
                            @if($pokemon->caught_at)
                                <div class="flex items-center gap-4">
                                    <span class="text-2xl">📅</span>
                                    <div>
                                        <div class="font-medium">Data de Captura</div>
                                        <div class="text-base-content/70">{{ $pokemon->caught_at->format('d/m/Y') }}</div>
                                    </div>
                                </div>
                            @endif
                            @if($pokemon->location_caught)
                                <div class="flex items-center gap-4">
                                    <span class="text-2xl">📍</span>
                                    <div>
                                        <div class="font-medium">Local de Captura</div>
                                        <div class="text-base-content/70">{{ $pokemon->location_caught }}</div>
                                    </div>
                                </div>
                            @endif
                            @if($pokemon->buddy_level)
                                <div class="flex items-center gap-4">
                                    <span class="text-2xl">💎</span>
                                    <div>
                                        <div class="font-medium">Nível de Companheiro</div>
                                        <div class="badge badge-info">
                                            @switch($pokemon->buddy_level)
                                                @case('good') 🥉 Good Buddy @break
                                                @case('great') 🥈 Great Buddy @break
                                                @case('ultra') 🥇 Ultra Buddy @break
                                                @case('best') 💎 Best Buddy @break
                                                @default {{ ucfirst($pokemon->buddy_level) }}
                                            @endswitch
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if($pokemon->notes)
                                <div class="flex gap-4">
                                    <span class="text-2xl">📝</span>
                                    <div class="flex-1">
                                        <div class="font-medium mb-2">Notas</div>
                                        <div class="p-3 bg-base-200 rounded-lg text-base-content/80">
                                            {{ $pokemon->notes }}
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Ações -->
    <div class="card bg-base-100 shadow-xl mt-6">
        <div class="card-body">
            <div class="card-actions justify-center gap-4">
                <a href="{{ route('pokemon.edit', $pokemon) }}" class="btn btn-primary btn-lg">
                    Editar Pokémon
                </a>
                <form action="{{ route('pokemon.destroy', $pokemon) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline btn-error btn-lg"
                            onclick="return confirm('Tem certeza que deseja remover {{ $pokemon->name }} da sua coleção? Esta ação não pode ser desfeita.')">
                        Remover da Coleção
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>