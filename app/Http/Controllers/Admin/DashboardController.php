<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Umkm;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_umkm' => Umkm::count(),
            'total_products' => Product::count(),
            'total_categories' => Category::count(),
            'total_users' => User::count(),
            'active_umkm' => Umkm::where('status', 'active')->count(),
            'active_products' => Product::where('status', 'active')->count(),
        ];

        $recent_umkm = Umkm::with('user')->latest()->take(5)->get();
        $recent_products = Product::with('umkm')->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recent_umkm', 'recent_products'));
    }
}
