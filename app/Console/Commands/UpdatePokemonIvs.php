<?php

namespace App\Console\Commands;

use App\Models\Pokemon;
use Illuminate\Console\Command;

class UpdatePokemonIvs extends Command
{
    protected $signature = 'pokemon:update-ivs';
    protected $description = 'Update is_perfect_iv and iv_percentage for all existing Pokemon';

    public function handle()
    {
        $this->info('Updating Pokemon IVs...');

        $pokemon = Pokemon::whereNotNull('iv_attack')
            ->whereNotNull('iv_defense')
            ->whereNotNull('iv_hp')
            ->get();

        $updated = 0;

        foreach ($pokemon as $poke) {
            // Calcula is_perfect_iv
            $isPerfect = ($poke->iv_attack === 15 && $poke->iv_defense === 15 && $poke->iv_hp === 15);
            
            // Calcula iv_percentage
            $percentage = round((($poke->iv_attack + $poke->iv_defense + $poke->iv_hp) / 45) * 100, 2);

            // Atualiza apenas se necessário
            if ($poke->is_perfect_iv !== $isPerfect || abs($poke->iv_percentage - $percentage) > 0.01) {
                $poke->is_perfect_iv = $isPerfect;
                $poke->iv_percentage = $percentage;
                $poke->save();
                $updated++;
            }
        }

        $this->info("Updated {$updated} Pokemon records.");
        
        // Mostra quantos são perfeitos
        $perfectCount = Pokemon::where('is_perfect_iv', true)->count();
        $this->info("Total perfect IV Pokemon: {$perfectCount}");

        return 0;
    }
}
