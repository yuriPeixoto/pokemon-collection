<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl leading-tight">
                ⚡ Novo Ataque Rápido
            </h2>
            <a href="{{ route('admin.fast-moves.index') }}" class="btn btn-outline btn-sm">
                ← Voltar à Lista
            </a>
        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <form action="{{ route('admin.fast-moves.store') }}" method="POST">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nome -->
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-semibold">Nome *</span>
                        </label>
                        <input type="text" name="name" value="{{ old('name') }}"
                               class="input input-bordered @error('name') input-error @enderror"
                               placeholder="Ex: Ataque Rápido" required>
                        @error('name')
                            <label class="label">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </label>
                        @enderror
                    </div>

                    <!-- Nome em Inglês -->
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-semibold">Nome em Inglês</span>
                        </label>
                        <input type="text" name="name_en" value="{{ old('name_en') }}"
                               class="input input-bordered @error('name_en') input-error @enderror"
                               placeholder="Ex: Quick Attack">
                        @error('name_en')
                            <label class="label">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </label>
                        @enderror
                    </div>

                    <!-- Tipo -->
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-semibold">Tipo *</span>
                        </label>
                        <select name="type" class="select select-bordered @error('type') select-error @enderror" required>
                            <option value="">Selecione o tipo</option>
                            <option value="Normal" {{ old('type') == 'Normal' ? 'selected' : '' }}>Normal</option>
                            <option value="Fighting" {{ old('type') == 'Fighting' ? 'selected' : '' }}>Fighting</option>
                            <option value="Flying" {{ old('type') == 'Flying' ? 'selected' : '' }}>Flying</option>
                            <option value="Poison" {{ old('type') == 'Poison' ? 'selected' : '' }}>Poison</option>
                            <option value="Ground" {{ old('type') == 'Ground' ? 'selected' : '' }}>Ground</option>
                            <option value="Rock" {{ old('type') == 'Rock' ? 'selected' : '' }}>Rock</option>
                            <option value="Bug" {{ old('type') == 'Bug' ? 'selected' : '' }}>Bug</option>
                            <option value="Ghost" {{ old('type') == 'Ghost' ? 'selected' : '' }}>Ghost</option>
                            <option value="Steel" {{ old('type') == 'Steel' ? 'selected' : '' }}>Steel</option>
                            <option value="Fire" {{ old('type') == 'Fire' ? 'selected' : '' }}>Fire</option>
                            <option value="Water" {{ old('type') == 'Water' ? 'selected' : '' }}>Water</option>
                            <option value="Grass" {{ old('type') == 'Grass' ? 'selected' : '' }}>Grass</option>
                            <option value="Electric" {{ old('type') == 'Electric' ? 'selected' : '' }}>Electric</option>
                            <option value="Psychic" {{ old('type') == 'Psychic' ? 'selected' : '' }}>Psychic</option>
                            <option value="Ice" {{ old('type') == 'Ice' ? 'selected' : '' }}>Ice</option>
                            <option value="Dragon" {{ old('type') == 'Dragon' ? 'selected' : '' }}>Dragon</option>
                            <option value="Dark" {{ old('type') == 'Dark' ? 'selected' : '' }}>Dark</option>
                            <option value="Fairy" {{ old('type') == 'Fairy' ? 'selected' : '' }}>Fairy</option>
                        </select>
                        @error('type')
                            <label class="label">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </label>
                        @enderror
                    </div>

                    <!-- Poder -->
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-semibold">Poder *</span>
                        </label>
                        <input type="number" name="power" value="{{ old('power') }}" min="0"
                               class="input input-bordered @error('power') input-error @enderror"
                               placeholder="Ex: 5" required>
                        @error('power')
                            <label class="label">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </label>
                        @enderror
                    </div>

                    <!-- Energia -->
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-semibold">Energia *</span>
                        </label>
                        <input type="number" name="energy" value="{{ old('energy') }}" min="0"
                               class="input input-bordered @error('energy') input-error @enderror"
                               placeholder="Ex: 8" required>
                        @error('energy')
                            <label class="label">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </label>
                        @enderror
                    </div>

                    <!-- Duração -->
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-semibold">Duração (segundos) *</span>
                        </label>
                        <input type="number" name="duration" value="{{ old('duration') }}" min="0" step="0.01"
                               class="input input-bordered @error('duration') input-error @enderror"
                               placeholder="Ex: 0.5" required>
                        @error('duration')
                            <label class="label">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </label>
                        @enderror
                    </div>

                    <!-- DPS -->
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-semibold">DPS (Damage Per Second)</span>
                        </label>
                        <input type="number" name="dps" value="{{ old('dps') }}" min="0" step="0.01"
                               class="input input-bordered @error('dps') input-error @enderror"
                               placeholder="Ex: 10.0">
                        @error('dps')
                            <label class="label">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </label>
                        @enderror
                    </div>

                    <!-- EPS -->
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-semibold">EPS (Energy Per Second)</span>
                        </label>
                        <input type="number" name="eps" value="{{ old('eps') }}" min="0" step="0.01"
                               class="input input-bordered @error('eps') input-error @enderror"
                               placeholder="Ex: 16.0">
                        @error('eps')
                            <label class="label">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </label>
                        @enderror
                    </div>
                </div>

                <!-- Checkbox -->
                <div class="form-control mt-6">
                    <label class="label cursor-pointer justify-start">
                        <input type="checkbox" name="is_legacy" value="1" {{ old('is_legacy') ? 'checked' : '' }}
                               class="checkbox checkbox-primary mr-3">
                        <span class="label-text font-semibold">Este é um ataque legado (não está mais disponível no jogo)</span>
                    </label>
                </div>

                <!-- Descrição -->
                <div class="form-control mt-6">
                    <label class="label">
                        <span class="label-text font-semibold">Descrição</span>
                    </label>
                    <textarea name="description" rows="3"
                              class="textarea textarea-bordered @error('description') textarea-error @enderror"
                              placeholder="Descrição opcional do ataque...">{{ old('description') }}</textarea>
                    @error('description')
                        <label class="label">
                            <span class="label-text-alt text-error">{{ $message }}</span>
                        </label>
                    @enderror
                </div>

                <!-- Botões -->
                <div class="flex justify-end space-x-3 mt-8">
                    <a href="{{ route('admin.fast-moves.index') }}" class="btn btn-outline">
                        Cancelar
                    </a>
                    <button type="submit" class="btn btn-primary">
                        Criar Ataque Rápido
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>