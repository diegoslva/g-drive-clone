<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
  {
      $this->call(RolesSeeder::class);
      $this->call(PermissionsTableSeeder::class);
      $this->call(PermissionsRoleTableSeeder::class);
      $this->call(UserSeeder::class);
      $this->call(RoleUsersSeeder::class);
      $this->call(DirectorySeeder::class);
    }
}
