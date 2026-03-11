<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Console;
use Illuminate\Database\Eloquent\Factories\Factory;

class ConsoleFactory extends Factory
{
  protected $model = Console::class;

  public function definition(): array
  {
    $consoles = [
      ['name' => 'PlayStation 5', 'category' => 'playstation'],
      ['name' => 'PlayStation 4 Pro', 'category' => 'playstation'],
      ['name' => 'PlayStation 4 Slim', 'category' => 'playstation'],
      ['name' => 'Xbox Series X', 'category' => 'xbox'],
      ['name' => 'Xbox Series S', 'category' => 'xbox'],
      ['name' => 'Xbox One X', 'category' => 'xbox'],
      ['name' => 'Nintendo Switch OLED', 'category' => 'nintendo'],
      ['name' => 'Nintendo Switch Lite', 'category' => 'nintendo'],
      ['name' => 'Nintendo 3DS XL', 'category' => 'nintendo'],
      ['name' => 'Super Nintendo Classic', 'category' => 'retro-gaming'],
      ['name' => 'Sega Mega Drive Mini', 'category' => 'retro-gaming'],
      ['name' => 'Steam Deck', 'category' => 'pc-gaming'],
      ['name' => 'ROG Ally', 'category' => 'pc-gaming'],
    ];

    $console = $this->faker->randomElement($consoles);
    $category = Category::where('slug', $console['category'])->first();

    return [
      'name' => $console['name'],
      'description' => $this->faker->paragraph(3),
      'price' => $this->faker->randomFloat(2, 99, 599),
      'condition' => $this->faker->randomElement(['neuf', 'très bon', 'bon', 'acceptable']),
      'category_id' => $category?->id ?? 1,
      'is_available' => true,
      'image' => null,
    ];
  }
}
