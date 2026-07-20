<?php

namespace Database\Seeders;

use App\Models\Game;
use Illuminate\Database\Seeder;

class GameSeeder extends Seeder
{
    public function run(): void
    {
        $games = [
            ['name' => 'Free Fire', 'icon' => 'https://cdn.simpleicons.org/garena/ff5357'],
            ['name' => 'Mobile Legends', 'icon' => 'https://cdn.simpleicons.org/mobilelegends/ff5357'],
            ['name' => 'PUBG Mobile', 'icon' => 'https://cdn.simpleicons.org/pubg/ff5357'],
            ['name' => 'Valorant', 'icon' => 'https://cdn.simpleicons.org/valorant/ff5357'],
            ['name' => 'Genshin Impact', 'icon' => 'https://cdn.simpleicons.org/genshinimpact/ff5357'],
            ['name' => 'Honor of Kings', 'icon' => 'https://cdn.simpleicons.org/honorofkings/ff5357'],
        ];

        foreach ($games as $g) {
            Game::firstOrCreate(['name' => $g['name']], $g);
        }
    }
}
