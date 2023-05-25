<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Transaction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('packages_id');
            $table->integer('staf_id');
            $table->string('customer_name');
            $table->string('customer_nik');
            $table->string('customer_address');
            $table->string('customer_phone');
            $table->integer('nominal');
            $table->integer('qty');
            $table->string('satuan');
            $table->string('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaction');
    }
}
