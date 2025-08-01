<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        User::create([
            'name' => 'Dan',
            'email' => 'dan@gmail.com',
            // Usamos Hash::make() para asegurarnos de que la contraseña esté encriptada
            'password' => Hash::make('123456'),
            'role_id' => 1, // Asegúrate de que el role_id exista
        ]);

        $adminRole = Role::where('name', 'admin')->first();
        $userRole = Role::where('name', 'user')->first();

        // 5 usuarios con el rol de 'admin'
        User::factory()->count(5)->create(['role_id' => $adminRole->id]);

        // 50 usuarios con el rol de 'user'
        User::factory()->count(50)->create(['role_id' => $userRole->id]);

        // Si tienes otros usuarios que quieres agregar, puedes hacerlo aquí
        // User::create([
        //     'name' => 'Jane Doe',
        //     'email' => 'jane@gmail.com',
        //     'password' => Hash::make('password'),
        //     'role_id' => 2,
        // ]);
    }
}
