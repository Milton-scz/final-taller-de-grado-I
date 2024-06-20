<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(ServicioSeeder::class);
        $this->call(AlmacenSeeder::class);
        $this->call(VerticeSeeder::class);
        $this->call(RutaSeeder::class);
        $this->call(ArcoSeeder::class);
    }
}
