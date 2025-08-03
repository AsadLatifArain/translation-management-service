<?php

namespace Database\Seeders;

use App\Models\Translation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $total = 100_000;
        $chunk = 1000;

        for ($i = 0; $i < $total / $chunk; $i++) {
            Translation::factory()->count($chunk)->create();
        }
    }
}
