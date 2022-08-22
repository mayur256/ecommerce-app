<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_images', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name', 255);
            $table->string('path');
            $table->integer('product_id')->unsigned()->index();
            $table->timestamps(); // created_at, deleted_at
            $table->softDeletes(); // deleted_at

            // foreign keys
            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // first drop foreign key index
        Schema::table('product_images', function(Blueprint $table) {
			$table->dropForeign(['product_id']);
		});

        // then drop table
        Schema::dropIfExists('product_images');
    }
}
