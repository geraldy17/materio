<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DummyUsersSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $userData = [
      [
        'name' => 'Bagian Sekretaris',
        'email' => 'sekretaris@gmail.com',
        'role' => 'sekretaris',
        'password' => bcrypt('123456'),
      ],

      [
        'name' => 'Bagian Pengguna',
        'email' => 'pengguna@gmail.com',
        'role' => 'pengguna',
        'password' => bcrypt('123456'),
      ],
    ];

    foreach ($userData as $key => $val) {
      User::create($val);
    }
  }
}
