<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ChargeMove extends Model
{
    protected $fillable = [
        'name',
        'name_en',
        'type',
        'power',
        'energy_cost',
        'bars',
        'dpe',
        'has_debuff',
        'debuff_chance',
        'debuff_type',
        'debuff_stages',
        'is_legacy',
        'description',
    ];

    protected $casts = [
        'has_debuff' => 'boolean',
        'is_legacy' => 'boolean',
        'dpe' => 'decimal:2',
        'debuff_chance' => 'decimal:2',
    ];

    public function pokemonSlot1(): HasMany
    {
        return $this->hasMany(Pokemon::class, 'charge_move_1_id');
    }

    public function pokemonSlot2(): HasMany
    {
        return $this->hasMany(Pokemon::class, 'charge_move_2_id');
    }

    public function scopeNotLegacy($query)
    {
        return $query->where('is_legacy', false);
    }

    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    public function scopeByBars($query, $bars)
    {
        return $query->where('bars', $bars);
    }

    public function getDisplayNameAttribute(): string
    {
        return $this->name_en ?? $this->name;
    }

    public function getBarsTextAttribute(): string
    {
        return match($this->bars) {
            1 => '1 barra',
            2 => '2 barras',
            3 => '3 barras',
            default => $this->bars . ' barras',
        };
    }
}