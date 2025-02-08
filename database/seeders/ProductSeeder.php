<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'name' => 'Meja Kayu Minimalis',
            'description' => 'Meja kayu minimalis dengan desain modern.',
            'price' => 1500000,
            'stock' => 10,
            'category_id' => 1, // Meja
        ]);
        
        Product::create([
            'name' => 'Kursi Kantor Ergonomis',
            'description' => 'Kursi kantor dengan desain ergonomis untuk kenyamanan.',
            'price' => 1200000,
            'stock' => 15,
            'category_id' => 2, // Kursi
        ]);
        
        Product::create([
            'name' => 'Lemari Pakaian 3 Pintu',
            'description' => 'Lemari pakaian dengan tiga pintu dan banyak ruang penyimpanan.',
            'price' => 2500000,
            'stock' => 8,
            'category_id' => 3, // Lemari
        ]);
        
        Product::create([
            'name' => 'Toilet Duduk Modern',
            'description' => 'Toilet duduk dengan desain modern dan nyaman.',
            'price' => 1800000,
            'stock' => 12,
            'category_id' => 4, // Toilet
        ]);
        
        Product::create([
            'name' => 'Dipan Kayu Jati',
            'description' => 'Dipan kayu jati yang kokoh dan elegan.',
            'price' => 3200000,
            'stock' => 7,
            'category_id' => 5, // Dipan
        ]);
        
        Product::create([
            'name' => 'Meja Makan Kayu',
            'description' => 'Meja makan kayu solid untuk keluarga.',
            'price' => 4500000,
            'stock' => 5,
            'category_id' => 1, // Meja
        ]);
        
        Product::create([
            'name' => 'Kursi Tamu Klasik',
            'description' => 'Kursi tamu dengan desain klasik dan elegan.',
            'price' => 5000000,
            'stock' => 6,
            'category_id' => 2, // Kursi
        ]);
        
        Product::create([
            'name' => 'Meja Kerja Minimalis',
            'description' => 'Meja kerja minimalis dengan desain modern.',
            'price' => 1400000,
            'stock' => 9,
            'category_id' => 1, // Meja
        ]);
        
        Product::create([
            'name' => 'Lemari Dapur Modern',
            'description' => 'Lemari dapur dengan desain modern dan praktis.',
            'price' => 2100000,
            'stock' => 10,
            'category_id' => 3, // Lemari
        ]);
        
        Product::create([
            'name' => 'Dipan Minimalis',
            'description' => 'Dipan minimalis yang cocok untuk kamar tidur modern.',
            'price' => 900000,
            'stock' => 20,
            'category_id' => 5, // Dipan
        ]);
    }
}
