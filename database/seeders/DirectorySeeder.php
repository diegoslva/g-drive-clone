<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DirectorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('folders')->insert([
        [
          'name' => 'Parent Directory',
          'user_id' => 1,
          'created_at' => now(),
          'updated_at' => now(),
        ],
        [
          'name' => 'Parent Directory',
          'user_id' => 2,
          'created_at' => now(),
          'updated_at' => now(),
        ]
      ]);
    }
}
