<?php

namespace Database\Seeders;

use App\Models\Console;
use App\Models\Category;
use Illuminate\Database\Seeder;

class ConsoleSeeder extends Seeder
{
    public function run(): void
    {
        $playstation = Category::where('slug', 'playstation')->first();
        $xbox = Category::where('slug', 'xbox')->first();
        $nintendo = Category::where('slug', 'nintendo')->first();
        $retro = Category::where('slug', 'retro')->first();
        $portable = Category::where('slug', 'portable')->first();

        $consoles = [
            // PlayStation
            [
                'name' => 'PlayStation 5',
                'description' => 'Console Sony PlayStation 5 avec manette DualSense. Parfait état, peu utilisée.',
                'price' => 449.99,
                'condition' => 'très bon',
                'category_id' => $playstation->id,
            ],
            [
                'name' => 'PlayStation 4 Pro',
                'description' => 'PS4 Pro 1To noire. Fonctionne parfaitement.',
                'price' => 249.99,
                'condition' => 'bon',
                'category_id' => $playstation->id,
            ],
            [
                'name' => 'PlayStation 2 Slim',
                'description' => 'PS2 Slim avec 2 manettes et carte mémoire.',
                'price' => 79.99,
                'condition' => 'acceptable',
                'category_id' => $playstation->id,
            ],

            // Xbox
            [
                'name' => 'Xbox Series X',
                'description' => 'Xbox Series X 1To. Comme neuve avec boîte d\'origine.',
                'price' => 429.99,
                'condition' => 'neuf',
                'category_id' => $xbox->id,
            ],
            [
                'name' => 'Xbox One S',
                'description' => 'Xbox One S 500Go blanche avec manette.',
                'price' => 179.99,
                'condition' => 'bon',
                'category_id' => $xbox->id,
            ],

            // Nintendo
            [
                'name' => 'Nintendo Switch OLED',
                'description' => 'Switch OLED blanche avec dock et Joy-Cons.',
                'price' => 299.99,
                'condition' => 'très bon',
                'category_id' => $nintendo->id,
            ],
            [
                'name' => 'Nintendo 64',
                'description' => 'N64 avec 2 manettes et câbles. Testée et fonctionnelle.',
                'price' => 89.99,
                'condition' => 'acceptable',
                'category_id' => $nintendo->id,
            ],
            [
                'name' => 'Super Nintendo (SNES)',
                'description' => 'SNES en très bon état avec manette d\'origine.',
                'price' => 119.99,
                'condition' => 'très bon',
                'category_id' => $nintendo->id,
            ],

            // Retro
            [
                'name' => 'Sega Mega Drive',
                'description' => 'Mega Drive avec manette 6 boutons.',
                'price' => 69.99,
                'condition' => 'bon',
                'category_id' => $retro->id,
            ],
            [
                'name' => 'Atari 2600',
                'description' => 'Atari 2600 vintage avec joysticks.',
                'price' => 99.99,
                'condition' => 'acceptable',
                'category_id' => $retro->id,
            ],

            // Portable
            [
                'name' => 'Nintendo Switch Lite',
                'description' => 'Switch Lite turquoise. Parfait pour jouer en déplacement.',
                'price' => 169.99,
                'condition' => 'très bon',
                'category_id' => $portable->id,
            ],
            [
                'name' => 'PlayStation Vita',
                'description' => 'PS Vita OLED avec carte mémoire 16Go.',
                'price' => 149.99,
                'condition' => 'bon',
                'category_id' => $portable->id,
            ],
            [
                'name' => 'Game Boy Advance SP',
                'description' => 'GBA SP bleu avec chargeur. Écran rétroéclairé.',
                'price' => 89.99,
                'condition' => 'très bon',
                'category_id' => $portable->id,
            ],
        ];

        foreach ($consoles as $console) {
            Console::firstOrCreate(
                ['name' => $console['name']],
                $console
            );
        }
    }
}
