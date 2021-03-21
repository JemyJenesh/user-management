<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\SettingSeeder;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder {
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run() {
    $permissions = [
      'access users', 'show users', 'create users', 'edit users', 'delete users',
      'access roles', 'show roles', 'create roles', 'edit roles', 'delete roles',
    ];
    $roles = ['Super Admin', 'Admin', 'User'];
    foreach ($permissions as $permission) {
      Permission::create(['name' => $permission]);
    }
    foreach ($roles as $role) {
      Role::create(['name' => $role]);
    }
    $superAdmin = User::create([
      'name' => 'Super Admin',
      'email' => 'superadmin@quizy.com',
      'password' => Hash::make('password'),
      'email_verified_at' => now(),
    ]);
    $superAdmin->assignRole('Super Admin');
    // \App\Models\User::factory(20)->create();

    $this->call([SettingSeeder::class]);
  }
}
