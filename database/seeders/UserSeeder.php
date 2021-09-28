<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('users')->insert([
        [
          'name' => 'Diego silva (admin)',
          'email' => 'diego@renovedigital.com.br',
          'cnpj' => '00000000000001',
          'password' => bcrypt('1234567'),
          'created_at' => now(),
          'updated_at' => now(),
        ],
        [
          'name' => 'Renove (admin)',
          'email' => 'renove@renovedigital.com.br',
          'cnpj' => '000000000001',
          'password' => bcrypt('1234567'),
          'created_at' => now(),
          'updated_at' => now(),
        ]
      ]);
    }
}
