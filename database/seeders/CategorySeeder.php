<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
  public function run(): void
  {
    $categories = [
      [
        'name' => 'PlayStation',
        'description' => 'Consoles Sony PlayStation (PS1, PS2, PS3, PS4, PS5)',
      ],
      [
        'name' => 'Xbox',
        'description' => 'Consoles Microsoft Xbox (Xbox, Xbox 360, Xbox One, Xbox Series)',
      ],
      [
        'name' => 'Nintendo',
        'description' => 'Consoles Nintendo (Switch, Wii, GameCube, N64, SNES, NES)',
      ],
      [
        'name' => 'Retro',
        'description' => 'Consoles rétro et vintage (Atari, Sega, Neo Geo...)',
      ],
      [
        'name' => 'Portable',
        'description' => 'Consoles portables (Game Boy, PSP, PS Vita, 3DS...)',
      ],
    ];

    foreach ($categories as $category) {
      Category::firstOrCreate(
        ['slug' => Str::slug($category['name'])],
        [
          'name' => $category['name'],
          'slug' => Str::slug($category['name']),
          'description' => $category['description'],
        ]
      );
    }
  }
}
