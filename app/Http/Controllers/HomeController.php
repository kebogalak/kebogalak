<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Umkm;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featured_products = Product::with(['umkm', 'images'])
            ->where('status', 'active')
            ->latest()
            ->take(8)
            ->get();

        $categories = Category::withCount('products')->take(6)->get();
        
        $umkms = Umkm::where('status', 'active')
            ->withCount('products')
            ->orderBy('products_count', 'desc')
            ->take(6)
            ->get();

        return view('home', compact('featured_products', 'categories', 'umkms'));
    }

    public function product(Product $product)
    {
        if ($product->status !== 'active') {
            abort(404);
        }

        $product->load(['umkm', 'categories', 'images']);
        
        $related_products = Product::with('images')
            ->where('status', 'active')
            ->where('id', '!=', $product->id)
            ->where('umkm_id', $product->umkm_id)
            ->take(4)
            ->get();

        return view('product', compact('product', 'related_products'));
    }

    public function umkm(Umkm $umkm)
    {
        if ($umkm->status !== 'active') {
            abort(404);
        }

        $products = $umkm->products()
            ->where('status', 'active')
            ->with('images')
            ->paginate(12);

        return view('umkm-detail', compact('umkm', 'products'));
    }
}
