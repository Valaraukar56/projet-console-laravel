<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
  public function run(): void
  {
    // Créer le rôle admin s'il n'existe pas
    $adminRole = Role::firstOrCreate(['name' => 'admin']);

    // Créer l'utilisateur admin
    $admin = User::firstOrCreate(
      ['email' => 'admin@admin.fr'],
      [
        'name' => 'Admin',
        'password' => bcrypt('password'),
      ]
    );

    // Assigner le rôle admin
    $admin->assignRole($adminRole);
  }
}
