<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RoleSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $roles = [
      [
        'id' => 1,
        'name' => 'Super Admin',
        'slug' => Str::slug('Super Admin', '-'),
      ],

    ];
    foreach ($roles as $item):
      Role::updateOrCreate(
        ['id' => $item['id']],
        [
          'name' => $item['name'],
          'slug' => $item['slug'],
        ]);
    endforeach;
  }
}
