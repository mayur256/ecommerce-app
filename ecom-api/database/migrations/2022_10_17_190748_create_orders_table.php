<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('customer_id')->unsigned()->index();
            $table->string('summary');
            $table->string('order_status', 100)->default('pending');
            $table->string('payment_method', 100)->default('upi');
            $table->string('payment_status', 100)->default('awaiting');
            //$table->string('ship_status', 100);
            $table->timestamps(); // created_at, deleted_at
            $table->softDeletes(); // deleted_at

            // Foreign keys
            $table->foreign('customer_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
