<?php

namespace Database\Seeders;

use App\Models\PinnedArticle;
use Illuminate\Database\Seeder;

class PinnedArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PinnedArticle::factory()->count(5)->create();
    }
}
