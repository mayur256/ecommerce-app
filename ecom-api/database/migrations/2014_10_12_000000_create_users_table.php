<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('last_name');
            $table->string('city', 100);
            $table->string('state', 100);
            $table->string('pincode', 6);
            $table->string('organization')->nullable();
            $table->string('user_type', 128)->nullable();
            $table->string('gender', 10)->nullable();
            $table->string('address')->nullable();
            $table->string('billing_address')->nullable();
            $table->string('billing_city', 100)->nullable();
            $table->string('billing_state', 100)->nullable();
            $table->string('billing_pincode', 6)->nullable();
            $table->string('gst_number', 15)->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
