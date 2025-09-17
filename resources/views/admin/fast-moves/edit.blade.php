<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl leading-tight">
                ⚡ Editar: {{ $fastMove->name }}
            </h2>
            <a href="{{ route('admin.fast-moves.index') }}" class="btn btn-outline btn-sm">
                ← Voltar à Lista
            </a>
        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <form action="{{ route('admin.fast-moves.update', $fastMove) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nome -->
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-semibold">Nome *</span>
                        </label>
                        <input type="text" name="name" value="{{ old('name', $fastMove->name) }}"
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
                        <input type="text" name="name_en" value="{{ old('name_en', $fastMove->name_en) }}"
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
                            @foreach(['Normal', 'Fighting', 'Flying', 'Poison', 'Ground', 'Rock', 'Bug', 'Ghost', 'Steel', 'Fire', 'Water', 'Grass', 'Electric', 'Psychic', 'Ice', 'Dragon', 'Dark', 'Fairy'] as $type)
                                <option value="{{ $type }}" {{ old('type', $fastMove->type) == $type ? 'selected' : '' }}>{{ $type }}</option>
                            @endforeach
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
                        <input type="number" name="power" value="{{ old('power', $fastMove->power) }}" min="0"
                               class="input input-bordered @error('power') input-error @enderror" required>
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
                        <input type="number" name="energy" value="{{ old('energy', $fastMove->energy) }}" min="0"
                               class="input input-bordered @error('energy') input-error @enderror" required>
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
                        <input type="number" name="duration" value="{{ old('duration', $fastMove->duration) }}" min="0" step="0.01"
                               class="input input-bordered @error('duration') input-error @enderror" required>
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
                        <input type="number" name="dps" value="{{ old('dps', $fastMove->dps) }}" min="0" step="0.01"
                               class="input input-bordered @error('dps') input-error @enderror">
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
                        <input type="number" name="eps" value="{{ old('eps', $fastMove->eps) }}" min="0" step="0.01"
                               class="input input-bordered @error('eps') input-error @enderror">
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
                        <input type="checkbox" name="is_legacy" value="1" {{ old('is_legacy', $fastMove->is_legacy) ? 'checked' : '' }}
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
                              placeholder="Descrição opcional do ataque...">{{ old('description', $fastMove->description) }}</textarea>
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
                        Atualizar Ataque
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>