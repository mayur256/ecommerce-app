<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

// Carbon Date/Time Package
use Carbon\Carbon;

class CategorySeeder extends Seeder
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
        \DB::table('categories')->truncate();

        // data to be insereted in the table
        \DB::table('categories')->insert([
            0 => array(
                'category_name' => 'Fashion',
                'category_desc' => ' for apparel & clothing too.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),

            1 => array(
                'category_name' => 'Mobiles and Tablets',
                'category_desc' => ' serving smartphones & tablets.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),

            2 => array(
                'category_name' => 'Consumer Electronics',
                'category_desc' => NULL,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),

            3 => array(
                'category_name' => 'Books',
                'category_desc' => NULL,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),

            4 => array(
                'category_name' => 'Movie Tickets',
                'category_desc' => 'Tickets for Movies as well as Famous concerts and shows of various artists across cities',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),

            5 => array(
                'category_name' => 'Baby Products',
                'category_desc' => NULL,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),

            6 => array(
                'category_name' => 'Groceries',
                'category_desc' => 'Fruits, Vegetables, Dairy, Staples, etc.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),

            7 => array(
                'category_name' => 'Beauty',
                'category_desc' => 'Make Up, Men\'s Grooming, Skin care, Hair etc.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),

            8 => array(
                'category_name' => 'Beauty',
                'category_desc' => 'Make Up, Men\'s Grooming, Skin care, Hair etc.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),

            9 => array(
                'category_name' => 'Home Furnishings',
                'category_desc' => 'Home decor and furnitures.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
        ]);

        // reinstate foreign key checks
        // deactivate foreign key checks
        \DB::statement("SET FOREIGN_KEY_CHECKS=1;");
    }
}
