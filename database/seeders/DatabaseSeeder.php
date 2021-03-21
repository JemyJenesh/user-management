<?php

namespace Database\Seeders;

use App\Models\User;
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
    $permissions = ['access users', 'show users', 'create users', 'edit users', 'delete users'];
    $roles = ['Super Admin', 'Admin', 'User'];
    // \App\Models\User::factory(10)->create();
    foreach ($permissions as $permission) {
      Permission::create(['name' => $permission]);
    }
    foreach ($roles as $role) {
      Role::create(['name' => $role]);
    }
    User::create([
      'name' => 'Super Admin',
      'email' => 'superadmin@quizy.com',
      'password' => Hash::make('password'),
      'email_verified_at' => now(),
    ]);
  }
}
