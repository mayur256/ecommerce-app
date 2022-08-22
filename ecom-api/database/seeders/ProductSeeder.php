<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

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
                ''
            ),
        ]);

         // reinstate foreign key checks
        \DB::statement("SET FOREIGN_KEY_CHECKS=1;");
    }
}
