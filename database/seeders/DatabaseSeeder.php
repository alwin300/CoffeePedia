<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
           User::create([
            'username' => 'penjual1',
            'email' => 'penjual1@gmail.com',
            'role' => 'seller',
            'password' => bcrypt('password')
        ]);
           User::create([
            'username' => 'penjual2',
            'email' => 'penjual2@gmail.com',
            'role' => 'seller',
            'password' => bcrypt('password')
        ]);
           User::create([
            'username' => 'pembeli',
            'email' => 'pembeli@gmail.com',
            'role' => 'buyer',
            'password' => bcrypt('password')
        ]);
           User::create([
            'username' => 'pembeli1',
            'email' => 'pembeli1@gmail.com',
            'role' => 'buyer',
            'password' => bcrypt('password')
        ]);
        User::create([
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'role' => 'admin',
            'password' => bcrypt('password')
        ]);
           Product::create([
            'nama' => 'test',
            'user_id' => 1,
            'username'=> 'penjual1',
            'harga' => 10000,
            'stok' => 100,
            'berat' =>1000,
            'jenis' => 'test1',
            'deskripsi' => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quisquam soluta fugit expedita dicta, ipsa ducimus a tempore dolorem incidunt. Incidunt sequi nam accusantium officia expedita quae asperiores facere odit eos?",
            'image' => null,
        ]);
           Product::create([
            'nama' => 'testdua',
            'user_id' => 1,
            'username' =>'penjual1',
            'harga' => 20000,
            'stok' => 100,
            'berat' =>1000,
            'jenis' => 'test2',
            'deskripsi' => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quisquam soluta fugit expedita dicta, ipsa ducimus a tempore dolorem incidunt. Incidunt sequi nam accusantium officia expedita quae asperiores facere odit eos?",
            'image' => null,
        ]);
           Product::create([
            'nama' => 'test p2',
            'user_id' => 2,
            'username' => 'penjual2',
            'harga' => 10000,
            'stok' => 100,
            'berat' =>1000,
            'jenis' => 'test1',
            'deskripsi' => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quisquam soluta fugit expedita dicta, ipsa ducimus a tempore dolorem incidunt. Incidunt sequi nam accusantium officia expedita quae asperiores facere odit eos?",
            'image' => null,
        ]);
           Product::create([
            'nama' => 'p2testdua',
            'user_id' => 2,
            'username' => 'penjual2',
            'harga' => 20000,
            'stok' => 100,
            'berat' =>1000,
            'jenis' => 'test2',
            'deskripsi' => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quisquam soluta fugit expedita dicta, ipsa ducimus a tempore dolorem incidunt. Incidunt sequi nam accusantium officia expedita quae asperiores facere odit eos?",
            'image' => null,
        ]);
        // \App\Models\User::factory(10)->create();
    }
}
