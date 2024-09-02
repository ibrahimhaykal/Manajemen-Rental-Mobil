<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Hapus pengguna dengan email admin@admin.com jika ada
        User::where('email', 'admin@admin.com')->delete();

        // Buat pengguna baru
        User::create([
            'name'  => 'admin',
            'email' => 'admin@admin.com',
            'password'  => Hash::make('12345678'),
            'address' => '123 Admin Street',
            'phone_number' => '1234567890',
            'SIM_number' => 'SIM123456',
        ]);
    }
}
