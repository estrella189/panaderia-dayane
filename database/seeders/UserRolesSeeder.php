<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserRolesSeeder extends Seeder
{
    public function run(): void
    {
       
        User::updateOrCreate(
            ['email' => 'admin@panaderia.com'],
            [
                'name' => 'Administrador',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ]
        );

        
        User::updateOrCreate(
            ['email' => 'empleado@panaderia.com'],
            [
                'name' => 'Empleado',
                'password' => Hash::make('empleado123'),
                'role' => 'empleado',
            ]
        );

        
        User::updateOrCreate(
            ['email' => 'cliente@panaderia.com'],
            [
                'name' => 'Cliente',
                'password' => Hash::make('cliente123'),
                'role' => 'cliente',
            ]
        );
    }
}

