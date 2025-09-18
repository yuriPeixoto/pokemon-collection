<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FastMove extends Model
{
    protected $fillable = [
        'name',
        'name_en',
        'type',
        'power',
        'energy',
        'duration',
        'dps',
        'eps',
        'is_legacy',
        'description',
    ];

    protected $casts = [
        'is_legacy' => 'boolean',
        'duration' => 'decimal:2',
        'dps' => 'decimal:2',
        'eps' => 'decimal:2',
    ];

    public function pokemon(): HasMany
    {
        return $this->hasMany(Pokemon::class, 'fast_move_id');
    }

    public function scopeNotLegacy($query)
    {
        return $query->where('is_legacy', false);
    }

    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    public function getDisplayNameAttribute(): string
    {
        return $this->name_en ?? $this->name;
    }
}