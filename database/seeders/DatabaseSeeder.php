<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\AccountImage;
use App\Models\Game;
use App\Models\RentalPackage;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Game::truncate();
        Account::truncate();
        \App\Models\AccountImage::truncate();
        RentalPackage::truncate();
        Transaction::truncate();
        User::where('is_admin', false)->delete();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $this->call(GameSeeder::class);
        $this->call(RentalPackageSeeder::class);

        $users = [
            ['name' => 'Andi Pratama', 'email' => 'andi@example.com'],
            ['name' => 'Budi Santoso', 'email' => 'budi@example.com'],
            ['name' => 'Citra Dewi', 'email' => 'citra@example.com'],
            ['name' => 'Dimas Nugroho', 'email' => 'dimas@example.com'],
            ['name' => 'Eka Putri', 'email' => 'eka@example.com'],
        ];

        foreach ($users as $u) {
            User::firstOrCreate(
                ['email' => $u['email']],
                [
                    'name' => $u['name'],
                    'password' => bcrypt('password'),
                ]
            );
        }

        $ff = Game::where('name', 'Free Fire')->first();
        $ml = Game::where('name', 'Mobile Legends')->first();
        $pubg = Game::where('name', 'PUBG Mobile')->first();
        $valo = Game::where('name', 'Valorant')->first();
        $genshin = Game::where('name', 'Genshin Impact')->first();

        $accounts = [
            ['game_id' => $ff->id, 'title' => 'Sultan FF - Evo Gun Max', 'description' => 'Akun Free Fire Sultan dengan semua senjata evo maksimal. Sudah include legendary bundle dan V-Badge.', 'platform' => 'Android', 'server' => 'Indonesia', 'level' => '82', 'skin_info' => 'Evo Gun Max, Bundle Legendary, V-Badge, 120+ skin senjata', 'price_sell' => 1500000, 'status' => 'available'],
            ['game_id' => $ff->id, 'title' => 'FF Grandmaster - Skin Langka', 'description' => 'Akun Grandmaster dengan koleksi skin event langka tahun 2021-2024. Termasuk bundle collab eksklusif.', 'platform' => 'Android', 'server' => 'Indonesia', 'level' => '75', 'skin_info' => 'Bundle Collab, Skin Event 2021-2024, 80+ karakter', 'price_sell' => 850000, 'status' => 'available'],
            ['game_id' => $ff->id, 'title' => 'FF Heroic - Battle Royale Pro', 'description' => 'Rank Heroic siap dipakai. Dilengkapi dengan senjata legendary dan emote langka.', 'platform' => 'iOS', 'server' => 'Indonesia', 'level' => '68', 'skin_info' => 'Heroic Rank, Legendary Weapon, Rare Emote', 'price_sell' => 500000, 'status' => 'available'],

            ['game_id' => $ml->id, 'title' => 'Mythical Glory MLBB - 150+ Skins', 'description' => 'Rank Mythical Glory dengan 150+ skin collector dan legend. Semua hero unlocked.', 'platform' => 'Android', 'server' => 'Asia', 'level' => '120', 'skin_info' => '150+ Skins, All Heroes, Collector Skins, Legend Skins', 'price_sell' => 2500000, 'status' => 'available'],
            ['game_id' => $ml->id, 'title' => 'MLBB Mythic - Season Pass Veteran', 'description' => 'Akun Mythic dengan battle pass dari season 15 sampai sekarang.', 'platform' => 'Android', 'server' => 'Asia', 'level' => '95', 'skin_info' => 'Mythic Rank, BP Season 15+, Exclusive Season Skins', 'price_sell' => 1200000, 'status' => 'available'],
            ['game_id' => $ml->id, 'title' => 'MLBB Epic - Starter Pack', 'description' => 'Akun Epic rank cocok untuk main santai. Lengkap dengan hero meta dan beberapa skin keren.', 'platform' => 'iOS', 'server' => 'Asia', 'level' => '50', 'skin_info' => 'Epic Rank, 60+ Hero, 30+ Skins', 'price_sell' => 350000, 'status' => 'available'],

            ['game_id' => $pubg->id, 'title' => 'Conqueror PUBG - M416 Glacier', 'description' => 'Rank Conqueror dengan M416 Glacier Level 7 + full set Mummy putih langka.', 'platform' => 'Android', 'server' => 'Asia', 'level' => '85', 'skin_info' => 'M416 Glacier Lv7, Mummy Set, 50+ vehicle skins', 'price_sell' => 3200000, 'status' => 'available'],
            ['game_id' => $pubg->id, 'title' => 'PUBGM Ace - Royal Pass Veteran', 'description' => 'Akun Ace dengan royal pass dari season 10.', 'platform' => 'Android', 'server' => 'Indonesia', 'level' => '72', 'skin_info' => 'Ace Rank, RP Season 10+, Limited Outfit, 40+ gun skins', 'price_sell' => 950000, 'status' => 'available'],

            ['game_id' => $valo->id, 'title' => 'Radiant Valorant - Full Bundle', 'description' => 'Rank Radiant dengan koleksi bundle lengkap.', 'platform' => 'PC', 'server' => 'Asia Pacific', 'level' => '284', 'skin_info' => 'Radiant Rank, Reaver, Elderflame, RGX, Champions 2023', 'price_sell' => 4500000, 'status' => 'available'],
            ['game_id' => $valo->id, 'title' => 'Valorant Immortal - Skin Kolektor', 'description' => 'Rank Immortal 3 dengan skin-skin limited edition.', 'platform' => 'PC', 'server' => 'Asia Pacific', 'level' => '210', 'skin_info' => 'Immortal 3 Rank, BP Skins, Premium Melee', 'price_sell' => 1800000, 'status' => 'available'],

            ['game_id' => $genshin->id, 'title' => 'Genshin Whale - C6 Karakter', 'description' => 'Whale account dengan C6 Raiden, C6 Hu Tao, C6 Yelan.', 'platform' => 'Android', 'server' => 'Asia', 'level' => '60', 'skin_info' => 'C6 Raiden, C6 Hu Tao, C6 Yelan, R5 Engulfing, Homa, Aqua', 'price_sell' => 8500000, 'status' => 'available'],
            ['game_id' => $genshin->id, 'title' => 'Genshin AR60 - Veteran', 'description' => 'AR60 dengan exploration 100% semua region.', 'platform' => 'iOS', 'server' => 'Asia', 'level' => '60', 'skin_info' => 'AR60, 100% Exploration, 20+ 5 Stars', 'price_sell' => 3500000, 'status' => 'available'],
        ];

        foreach ($accounts as $a) {
            Account::firstOrCreate(
                ['title' => $a['title']],
                $a
            );
        }
    }
}
