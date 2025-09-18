<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pokemon extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'pokedex_number',
        'types',
        'sprite_url',
        'base_hp',
        'base_attack',
        'base_defense',
        'base_special_attack',
        'base_special_defense',
        'base_speed',
        'generation',
        'region',
        'cp',
        'hp',
        'iv_attack',
        'iv_defense',
        'iv_hp',
        'iv_percentage',
        'level',
        'is_perfect_iv',
        'is_shiny',
        'is_lucky',
        'is_shadow',
        'is_purified',
        'is_buddy',
        'buddy_level',
        'fast_move',
        'charge_move_1',
        'charge_move_2',
        'fast_move_id',
        'charge_move_1_id',
        'charge_move_2_id',
        'caught_at',
        'location_caught',
        'notes',
    ];

    protected $casts = [
        'types' => 'array',
        'is_perfect_iv' => 'boolean',
        'is_shiny' => 'boolean',
        'is_lucky' => 'boolean',
        'is_shadow' => 'boolean',
        'is_purified' => 'boolean',
        'is_buddy' => 'boolean',
        'caught_at' => 'date',
        'iv_percentage' => 'decimal:2',
        'level' => 'decimal:1',
    ];

    // Removido boot() - não funciona automaticamente

    /**
     * Atualiza os cálculos de IV
     */
    public function updateIvCalculations()
    {
        // Só calcula se todos os IVs estão preenchidos
        if ($this->iv_attack !== null && $this->iv_defense !== null && $this->iv_hp !== null) {
            // Calcula is_perfect_iv
            $this->is_perfect_iv = ($this->iv_attack === 15 && $this->iv_defense === 15 && $this->iv_hp === 15);
            
            // Calcula iv_percentage
            $this->iv_percentage = round((($this->iv_attack + $this->iv_defense + $this->iv_hp) / 45) * 100, 2);
        } else {
            // Se não tem todos os IVs, reseta os valores calculados
            $this->is_perfect_iv = false;
            $this->iv_percentage = null;
        }
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function fastMove(): BelongsTo
    {
        return $this->belongsTo(FastMove::class, 'fast_move_id');
    }

    public function chargeMove1(): BelongsTo
    {
        return $this->belongsTo(ChargeMove::class, 'charge_move_1_id');
    }

    public function chargeMove2(): BelongsTo
    {
        return $this->belongsTo(ChargeMove::class, 'charge_move_2_id');
    }

    public function getTypesStringAttribute(): string
    {
        return implode(', ', $this->types ?? []);
    }

    public function isPerfectIv(): bool
    {
        return $this->iv_attack === 15 && $this->iv_defense === 15 && $this->iv_hp === 15;
    }

    public function calculateIvPercentage(): float
    {
        if (!$this->iv_attack || !$this->iv_defense || !$this->iv_hp) {
            return 0;
        }

        return round((($this->iv_attack + $this->iv_defense + $this->iv_hp) / 45) * 100, 2);
    }

    public function scopeByType($query, $type)
    {
        return $query->whereRaw("JSON_SEARCH(types, 'one', ?) IS NOT NULL", [$type]);
    }

    public function scopePerfectIv($query)
    {
        return $query->where('is_perfect_iv', true);
    }

    public function scopeShiny($query)
    {
        return $query->where('is_shiny', true);
    }

    public function scopeLucky($query)
    {
        return $query->where('is_lucky', true);
    }

    public function scopeByRegion($query, $region)
    {
        return $query->where('region', $region);
    }

    public static function getTypeInfo($type)
    {
        $types = config('pokemon.types');
        return $types[$type] ?? [
            'name' => ucfirst($type),
            'color' => '#777777',
            'emoji' => '⚪'
        ];
    }

    public function getTypesWithInfoAttribute()
    {
        if (!$this->types) {
            return [];
        }

        return collect($this->types)->map(function ($type) {
            return self::getTypeInfo($type);
        })->toArray();
    }
}
