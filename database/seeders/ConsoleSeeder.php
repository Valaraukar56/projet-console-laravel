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
                'name' => 'PlayStation 2',
                'description' => 'Console Sony PlayStation 2 en bon état. La console la plus vendue de tous les temps.',
                'price' => 79.99,
                'condition' => 'bon',
                'category_id' => $playstation->id,
                'image' => 'consoles/PS2.jpg',
            ],

            // Xbox
            [
                'name' => 'Xbox 360',
                'description' => 'Console Microsoft Xbox 360 blanche avec manette sans fil.',
                'price' => 89.99,
                'condition' => 'bon',
                'category_id' => $xbox->id,
                'image' => 'consoles/Xbox_360.jpg',
            ],
            [
                'name' => 'Xbox One',
                'description' => 'Console Microsoft Xbox One noire 500Go avec manette.',
                'price' => 149.99,
                'condition' => 'très bon',
                'category_id' => $xbox->id,
                'image' => 'consoles/Xbox_one.jpg',
            ],

            // Nintendo - Consoles de salon
            [
                'name' => 'Nintendo Entertainment System (NES)',
                'description' => 'Console NES originale. La console qui a relancé l\'industrie du jeu vidéo.',
                'price' => 129.99,
                'condition' => 'bon',
                'category_id' => $nintendo->id,
                'image' => 'consoles/NES.jpg',
            ],
            [
                'name' => 'NES Mini Classic',
                'description' => 'NES Mini officielle Nintendo avec 30 jeux préinstallés.',
                'price' => 69.99,
                'condition' => 'très bon',
                'category_id' => $nintendo->id,
                'image' => 'consoles/NES_mini.jpg',
            ],
            [
                'name' => 'Super Nintendo (SNES)',
                'description' => 'Console Super Nintendo originale. L\'âge d\'or du jeu vidéo 16-bit.',
                'price' => 119.99,
                'condition' => 'bon',
                'category_id' => $nintendo->id,
                'image' => 'consoles/Super_NES.jpg',
            ],
            [
                'name' => 'SNES Mini Classic',
                'description' => 'SNES Mini officielle Nintendo avec 21 jeux préinstallés dont Star Fox 2.',
                'price' => 79.99,
                'condition' => 'très bon',
                'category_id' => $nintendo->id,
                'image' => 'consoles/SNES_mini.jpg',
            ],
            [
                'name' => 'Nintendo 64',
                'description' => 'Console Nintendo 64 avec manette. La révolution 3D de Nintendo.',
                'price' => 99.99,
                'condition' => 'bon',
                'category_id' => $nintendo->id,
                'image' => 'consoles/Nintendo_64.jpg',
            ],
            [
                'name' => 'Nintendo GameCube',
                'description' => 'Console Nintendo GameCube violette avec manette. Design compact et iconique.',
                'price' => 89.99,
                'condition' => 'bon',
                'category_id' => $nintendo->id,
                'image' => 'consoles/GameCube.jpg',
            ],
            [
                'name' => 'Nintendo Wii',
                'description' => 'Console Nintendo Wii blanche avec Wiimote. Révolution du motion gaming.',
                'price' => 59.99,
                'condition' => 'bon',
                'category_id' => $nintendo->id,
                'image' => 'consoles/Wii.jpg',
            ],
            [
                'name' => 'Nintendo Wii Mini',
                'description' => 'Version compacte de la Wii en rouge et noir.',
                'price' => 49.99,
                'condition' => 'très bon',
                'category_id' => $nintendo->id,
                'image' => 'consoles/Wii_mini.jpg',
            ],
            [
                'name' => 'Nintendo Wii U',
                'description' => 'Console Nintendo Wii U avec GamePad. Rétrocompatible Wii.',
                'price' => 129.99,
                'condition' => 'bon',
                'category_id' => $nintendo->id,
                'image' => 'consoles/Wii_U.jpg',
            ],
            [
                'name' => 'Nintendo Switch Édition Zelda',
                'description' => 'Nintendo Switch édition limitée Zelda Tears of the Kingdom.',
                'price' => 349.99,
                'condition' => 'très bon',
                'category_id' => $nintendo->id,
                'image' => 'consoles/Switch_Zelda.jpg',
            ],
            [
                'name' => 'Nintendo Switch 2',
                'description' => 'Nouvelle génération Nintendo Switch. Plus puissante avec écran amélioré.',
                'price' => 449.99,
                'condition' => 'neuf',
                'category_id' => $nintendo->id,
                'image' => 'consoles/Switch2.jpg',
            ],

            // Portable
            [
                'name' => 'Game Boy Classic',
                'description' => 'Console Game Boy originale grise. Le début du gaming portable.',
                'price' => 69.99,
                'condition' => 'bon',
                'category_id' => $portable->id,
                'image' => 'consoles/Gameboy.jpg',
            ],
            [
                'name' => 'Game Boy Color',
                'description' => 'Console Game Boy Color. La couleur arrive sur Game Boy.',
                'price' => 59.99,
                'condition' => 'bon',
                'category_id' => $portable->id,
                'image' => 'consoles/Gameboy_Color.jpg',
            ],
            [
                'name' => 'Game Boy Advance',
                'description' => 'Console Game Boy Advance violette transparente.',
                'price' => 69.99,
                'condition' => 'bon',
                'category_id' => $portable->id,
                'image' => 'consoles/Gameboy_Advance.jpg',
            ],
            [
                'name' => 'Game Boy Advance SP Édition Zelda',
                'description' => 'GBA SP édition limitée Zelda Minish Cap. Écran rétroéclairé.',
                'price' => 149.99,
                'condition' => 'très bon',
                'category_id' => $portable->id,
                'image' => 'consoles/Gameboy_Advance_SP_Zelda.jpg',
            ],
            [
                'name' => 'Nintendo DS Édition Zelda',
                'description' => 'Nintendo DS édition Phantom Hourglass. Double écran tactile.',
                'price' => 89.99,
                'condition' => 'bon',
                'category_id' => $portable->id,
                'image' => 'consoles/DS_Hourglass.jpg',
            ],
            [
                'name' => 'Nintendo 3DS XL Édition Zelda',
                'description' => 'Nintendo 3DS XL édition limitée A Link Between Worlds.',
                'price' => 179.99,
                'condition' => 'très bon',
                'category_id' => $portable->id,
                'image' => 'consoles/3DS_XL_Zelda.jpg',
            ],
            [
                'name' => 'Nintendo 3DS XL Édition Majora\'s Mask',
                'description' => 'Nintendo 3DS XL édition limitée Majora\'s Mask. Design doré unique.',
                'price' => 199.99,
                'condition' => 'très bon',
                'category_id' => $portable->id,
                'image' => 'consoles/3DS_XL_Majora.jpg',
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
