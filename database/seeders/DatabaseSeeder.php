<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Membuat user pertama (Sesuai buku)
        User::factory()->create([
            'name' => 'Haafiz',
            'email' => 'kaasib@gmail.com',
            'password' => 'qwerty', // Laravel otomatis akan men-enkripsi (hash) password ini
        ]);

        // 2. Membuat user kedua (Sesuai buku)
        User::factory()->create([
            'name' => 'Ali',
            'email' => 'abc@email.com',
            'password' => 'qwerty',
        ]);

        // Opsional: Kalau kamu mau otomatis bikin 10 user acak tambahan
        // User::factory(10)->create();
    }
}
