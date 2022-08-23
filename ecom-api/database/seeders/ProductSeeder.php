<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

// Carbon Date/Time Package
use Carbon\Carbon;


class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // deactivate foreign key checks
        \DB::statement("SET FOREIGN_KEY_CHECKS=0;");

        // Truncate the table before running a new instance of seeder
        \DB::table('products')->truncate();

        // insert the dummy data into the table
        \DB::table('products')->insert([
            0 => array(
                'name' => 'Men Regular Fit Solid Spread Collar Casual Shirt',
                'price' => 429.00,
                'desc' => 'Men Regular Fit Solid Spread Collar Casual Shirt',
                'brand' => 4,
                'category' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'deleted_at' => NULL
            ),

            1 => array(
                'name' => 'POCO X4 Pro 5G',
                'price' => 16999.00,
                'desc' => 'Laser Blue, 128 GB - 6 GB RAM',
                'brand' => 4,
                'category' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'deleted_at' => NULL
            ),

            2 => array(
                'name' => 'Rich Dad Poor Dad',
                'price' => 218,
                'desc' => 'Financial Education Book',
                'brand' => 5,
                'category' => 4,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'deleted_at' => NULL
            ),

            3 => array(
                'name' => 'limraz furniture Fabric 3 Seater Sofa',
                'price' => 7999,
                'desc' => 'Finish Color - Grey & Black, Pre-assembled',
                'brand' => 3,
                'category' => 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'deleted_at' => Carbon::now()
            ),

            4 => array(
                'name' => 'Lenovo Core i3 10th Gen',
                'price' => 36990,
                'desc' => '(8 GB/512 GB SSD/Windows 11 Home) 15IML05 Thin and Light Laptop  (15.6 inch, Platinum Grey, 1.7 Kg, With MS Office)',
                'brand' => 7,
                'category' => 3,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'deleted_at' => NULL
            ),
        ]);

         // reinstate foreign key checks
        \DB::statement("SET FOREIGN_KEY_CHECKS=1;");
    }
}
