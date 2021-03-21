<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //用User工廠來生成用戶假資料
        User::factory()
            ->count(1)
            ->create();

        //呼叫ItemsTableSeeder以生成商品假資料
        $this->call([
            ItemsTableSeeder::class
        ]);
    }
}
