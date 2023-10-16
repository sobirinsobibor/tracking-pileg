<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Cek apakah pengguna dengan email tertentu sudah ada
        if (User::where('email', 'wsobirin2@gmail.com')->count() === 0) {
            // Jika tidak ada, maka buat pengguna
            User::create([
                'name' => 'Imam Wahyu Sobirin',
                'email' => 'wsobirin2@gmail.com',
                'nik' => '1234567890123456',
                'telephone' => '081351798490',
                'address' => 'Jl. Wirabumi No.49 RT.01/08 Gedangan, Sidoarjo',
                'password' => Hash::make('password'),
                'id_role' => 1,
            ]);
        }
    }
}
