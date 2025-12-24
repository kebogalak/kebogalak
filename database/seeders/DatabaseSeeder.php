<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Umkm;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Create Admin
        $admin = User::create([
            'name' => 'Administrator',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Create Categories
        $categories = [
            ['name' => 'Makanan', 'slug' => 'makanan', 'description' => 'Produk makanan tradisional dan modern'],
            ['name' => 'Minuman', 'slug' => 'minuman', 'description' => 'Berbagai jenis minuman lokal'],
            ['name' => 'Kerajinan Tangan', 'slug' => 'kerajinan-tangan', 'description' => 'Produk kerajinan tangan khas daerah'],
            ['name' => 'Fashion', 'slug' => 'fashion', 'description' => 'Pakaian dan aksesoris lokal'],
            ['name' => 'Pertanian', 'slug' => 'pertanian', 'description' => 'Hasil pertanian dan perkebunan'],
        ];

        foreach ($categories as $cat) {
            Category::create($cat);
        }

        // Create UMKM Owner 1
        $owner1 = User::create([
            'name' => 'Budi Santoso',
            'email' => 'umkm@example.com',
            'password' => Hash::make('password'),
            'role' => 'umkm_owner',
        ]);

        $umkm1 = Umkm::create([
            'user_id' => $owner1->id,
            'name' => 'Warung Makan Bu Budi',
            'address' => 'Jl. Pasar Baru No. 15, Jakarta Pusat',
            'phone' => '081234567890',
            'email' => 'warungbudi@email.com',
            'description' => 'Warung makan tradisional dengan cita rasa masakan rumahan yang lezat. Berdiri sejak 2010.',
            'status' => 'active',
        ]);

        // Create Products for UMKM 1
        $products1 = [
            ['name' => 'Nasi Goreng Spesial', 'price' => 25000, 'stock' => 50, 'description' => 'Nasi goreng dengan telur, ayam, dan sayuran segar'],
            ['name' => 'Mie Ayam Bakso', 'price' => 20000, 'stock' => 30, 'description' => 'Mie ayam dengan bakso sapi pilihan'],
            ['name' => 'Soto Ayam', 'price' => 18000, 'stock' => 40, 'description' => 'Soto ayam khas dengan kuah kuning yang gurih'],
        ];

        foreach ($products1 as $prod) {
            $product = Product::create([
                'umkm_id' => $umkm1->id,
                'name' => $prod['name'],
                'slug' => Str::slug($prod['name']) . '-' . Str::random(5),
                'description' => $prod['description'],
                'price' => $prod['price'],
                'stock' => $prod['stock'],
                'status' => 'active',
            ]);
            $product->categories()->attach([1, 2]); // Makanan & Minuman
        }

        // Create UMKM Owner 2
        $owner2 = User::create([
            'name' => 'Siti Rahayu',
            'email' => 'siti@example.com',
            'password' => Hash::make('password'),
            'role' => 'umkm_owner',
        ]);

        $umkm2 = Umkm::create([
            'user_id' => $owner2->id,
            'name' => 'Batik Rahayu',
            'address' => 'Jl. Batik Indah No. 25, Solo',
            'phone' => '082345678901',
            'email' => 'batikrahayu@email.com',
            'description' => 'Produsen batik tulis asli Solo dengan motif tradisional dan modern.',
            'status' => 'active',
        ]);

        // Create Products for UMKM 2
        $products2 = [
            ['name' => 'Batik Tulis Parang', 'price' => 350000, 'stock' => 10, 'description' => 'Batik tulis motif parang klasik'],
            ['name' => 'Batik Cap Mega Mendung', 'price' => 175000, 'stock' => 25, 'description' => 'Batik cap dengan motif mega mendung'],
            ['name' => 'Kemeja Batik Pria', 'price' => 250000, 'stock' => 20, 'description' => 'Kemeja batik pria lengan pendek'],
        ];

        foreach ($products2 as $prod) {
            $product = Product::create([
                'umkm_id' => $umkm2->id,
                'name' => $prod['name'],
                'slug' => Str::slug($prod['name']) . '-' . Str::random(5),
                'description' => $prod['description'],
                'price' => $prod['price'],
                'stock' => $prod['stock'],
                'status' => 'active',
            ]);
            $product->categories()->attach([3, 4]); // Kerajinan & Fashion
        }

        $this->command->info('Database seeded successfully!');
        $this->command->info('');
        $this->command->info('Admin Login:');
        $this->command->info('Email: admin@example.com');
        $this->command->info('Password: password');
        $this->command->info('');
        $this->command->info('UMKM Owner Login:');
        $this->command->info('Email: umkm@example.com');
        $this->command->info('Password: password');
    }
}
