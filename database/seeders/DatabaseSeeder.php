<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed database aplikasi dengan user demo untuk setiap role.
     */
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Administrator SiGAP',
            'email' => 'admin@polsri.ac.id',
            'password' => bcrypt('admin123'),
            'role' => 'admin',
        ]);

        // Teknisi
        User::create([
            'name' => 'Teknisi Polsri',
            'email' => 'teknisi@polsri.ac.id',
            'password' => bcrypt('teknisi123'),
            'role' => 'teknisi',
        ]);

        // Mahasiswa
        User::create([
            'name' => 'Mahasiswa Demo',
            'email' => 'mahasiswa@polsri.ac.id',
            'password' => bcrypt('mahasiswa123'),
            'role' => 'mahasiswa',
        ]);
    }
}
