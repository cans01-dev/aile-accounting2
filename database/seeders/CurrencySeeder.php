<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $collection = [
            ['日本円']
        ];

        foreach ($collection as $item) {
            $currency = new Currency();
            $currency->title = $item[0];
            $currency->client_id = 1;
            $currency->save();
        }
    }
}
