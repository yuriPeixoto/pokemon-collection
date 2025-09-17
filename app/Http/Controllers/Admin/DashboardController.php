<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FastMove;
use App\Models\ChargeMove;
use App\Models\Pokemon;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_fast_moves' => FastMove::count(),
            'total_charge_moves' => ChargeMove::count(),
            'total_pokemon' => Pokemon::count(),
            'total_users' => User::count(),
            'legacy_fast_moves' => FastMove::where('is_legacy', true)->count(),
            'legacy_charge_moves' => ChargeMove::where('is_legacy', true)->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
