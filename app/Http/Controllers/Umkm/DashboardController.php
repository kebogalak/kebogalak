<?php

namespace App\Http\Controllers\Umkm;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $umkm = auth()->user()->umkm;
        
        if (!$umkm) {
            return redirect()->route('umkm.profile.create');
        }

        $stats = [
            'total_products' => $umkm->products()->count(),
            'active_products' => $umkm->products()->where('status', 'active')->count(),
            'inactive_products' => $umkm->products()->where('status', 'inactive')->count(),
        ];

        $recent_products = $umkm->products()->with('images')->latest()->take(5)->get();

        return view('umkm.dashboard', compact('umkm', 'stats', 'recent_products'));
    }
}
