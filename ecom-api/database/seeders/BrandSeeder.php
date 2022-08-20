<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

// Model
use \App\Models\Brand;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Brand::factory()
            ->count(10)
            ->create();
    }
}
