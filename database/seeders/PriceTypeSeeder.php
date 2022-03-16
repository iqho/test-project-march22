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
            'name' => 'Retail Price'
        ]);

        PriceType::create([
            'name' => 'Wholesale Price'
        ]);
    }
}
