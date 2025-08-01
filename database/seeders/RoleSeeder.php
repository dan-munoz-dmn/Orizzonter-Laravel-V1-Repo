<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {        
        Role::factory()->create(['name' => 'admin', 'display_name' => 'Administrador']);
        Role::factory()->create(['name' => 'moderator', 'display_name' => 'Moderador']);
        Role::factory()->create(['name' => 'user', 'display_name' => 'Usuario']);
    }
}
