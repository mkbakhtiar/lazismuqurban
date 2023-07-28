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
            $table->smallInteger('packages_id');
            $table->smallInteger('staf_id');
            $table->smallInteger('city_id');
            $table->smallInteger('province_id');
            $table->string('customer_name');
            $table->string('customer_nik');
            $table->string('customer_address');
            $table->string('customer_phone');
            $table->integer('nominal');
            $table->smallInteger('qty');
            $table->smallInteger('is_confirm')->nullable();
            $table->string('satuan');
            $table->string('description');
            $table->string('transaction_date');
            $table->smallInteger('is_delete')->nullable();
            $table->datetime('deleted_at')->nullable();
            $table->datetime('confirm_at')->nullable();
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
