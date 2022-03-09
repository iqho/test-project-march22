<?php

namespace Database\Seeders;

use App\Models\PriceType;
use Illuminate\Database\Seeder;

class PriceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PriceType::create([
            'price_type' => 'Retail Price'
        ]);

        PriceType::create([
            'price_type' => 'Wholesale Price'
        ]);
    }
}
