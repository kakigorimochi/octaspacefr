<?php

namespace Database\Seeders;

use App\Models\Content;
use Illuminate\Database\Seeder;

class ContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Content::count() > 0) Content::truncate();

        Content::create([
            'bscscan_api'  => '',
            'balance_octa' => 0,
            'balance_usdt' => 0
        ]);
    }
}
